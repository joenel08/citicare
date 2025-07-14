<script src="https://unpkg.com/jsqr/dist/jsQR.js"></script>
    <style>
        #scanner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f4f4;
        }
        #video {
            width: 80%;
            border: 2px solid #000;
        }
        #result {
            margin-top: 20px;
        }
    </style>
    <div id="scanner-container">
    <div>
        <video id="video" width="320" height="240" autoplay></video>
        <div id="result">
            <h3>Scan Result:</h3>
            <p id="result-text">Awaiting QR code scan...</p>
            <button id="mark-attendance" style="display:none;">Mark Attendance</button>
        </div>
    </div>
</div>

<script>
    let video = document.getElementById('video');
    let resultText = document.getElementById('result-text');
    let markAttendanceButton = document.getElementById('mark-attendance');

    // Set up video stream for QR code scanning
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(function(stream) {
            video.srcObject = stream;
            video.setAttribute("playsinline", true); // Required to play video inline on iOS
            video.play();
            requestAnimationFrame(scanQRCode);
        })
        .catch(function(error) {
            console.error("Error accessing the camera: ", error);
            alert("Could not access the camera.");
        });

    // Scan the video stream for a QR code
    function scanQRCode() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            let canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            let context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            let imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            let qrCode = jsQR(imageData.data, canvas.width, canvas.height);
            if (qrCode) {
                // QR code detected, stop scanning and show the result
                resultText.innerText = "QR Code Data: " + qrCode.data;
                markAttendanceButton.style.display = 'inline-block';
                
                // When the user clicks "Mark Attendance"
                markAttendanceButton.onclick = function() {
                    markAttendance(qrCode.data);
                };
            }
        }

        // Continue scanning the video stream
        requestAnimationFrame(scanQRCode);
    }

    // Function to mark attendance (can be extended to save to database)
    function markAttendance(qrCodeData) {
        alert("Attendance marked for user: " + qrCodeData);
        // You can replace the above alert with actual database interaction to save the attendance data
        window.location.href = "attendance_confirmation.php?user=" + encodeURIComponent(qrCodeData);
    }
</script>