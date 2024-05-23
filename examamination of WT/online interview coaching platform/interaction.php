<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Interaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        #video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .video-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            background-color: #000;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        video {
            width: 100%;
            height: auto;
            display: block;
        }
        .overlay {
            position: absolute;
            bottom: 10px;
            left: 10px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: #fff;
        }
        .overlay button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin-right: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .overlay button:hover {
            background-color: #c82333;
        }
        #controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        #controls button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #controls button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="video-grid">
        <!-- Video containers will be dynamically added here -->
    </div>
    <div id="controls">
        <button id="start-call">Start Call</button>
        <button id="end-call" disabled>End Call</button>
        <button id="share-screen">Share Screen</button>
    </div>

    <script>
        let localStream;
        let peerConnection;
        const videoGrid = document.getElementById('video-grid');
        const startButton = document.getElementById('start-call');
        const endButton = document.getElementById('end-call');
        const shareButton = document.getElementById('share-screen');

        startButton.addEventListener('click', startCall);
        endButton.addEventListener('click', endCall);
        shareButton.addEventListener('click', shareScreen);

        async function startCall() {
            startButton.disabled = true;
            endButton.disabled = false;

            try {
                localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                addVideoStream(localStream);

                const configuration = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };
                peerConnection = new RTCPeerConnection(configuration);

                localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

                peerConnection.ontrack = event => {
                    addVideoStream(event.streams[0]);
                };

                const offer = await peerConnection.createOffer();
                await peerConnection.setLocalDescription(offer);

                // Send offer to signaling server (replace 'YOUR_SIGNALING_SERVER_URL' with your server URL)
                const socket = new WebSocket('ws://YOUR_SIGNALING_SERVER_URL');
                socket.onopen = () => {
                    socket.send(JSON.stringify({ type: 'offer', offer: offer }));
                };
                socket.onmessage = async (event) => {
                    const message = JSON.parse(event.data);
                    if (message.type === 'answer') {
                        await peerConnection.setRemoteDescription(new RTCSessionDescription(message.answer));
                    }
                };

            } catch (error) {
                console.error('Error starting call:', error);
            }
        }

        function endCall() {
            startButton.disabled = false;
            endButton.disabled = true;

            localStream.getTracks().forEach(track => track.stop());
            peerConnection.close();
        }

        async function shareScreen() {
            try {
                const screenStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
                addVideoStream(screenStream);

                const senders = peerConnection.getSenders().find(sender => sender.track.kind === 'video');
                senders.replaceTrack(screenStream.getTracks()[0]);

                // Stop screen sharing after 30 seconds
                setTimeout(() => {
                    senders.replaceTrack(localStream.getTracks()[1]); // Restore camera stream
                    screenStream.getTracks().forEach(track => track.stop());
                }, 30000);
            } catch (error) {
                console.error('Error sharing screen:', error);
            }
        }

        function addVideoStream(stream) {
            const video = document.createElement('video');
            video.srcObject = stream;
            video.addEventListener('loadedmetadata', () => {
                video.play();
            });
            const container = document.createElement('div');
            container.className = 'video-container';
            container.appendChild(video);
            videoGrid.appendChild(container);
        }
    </script>
</body>
</html>
