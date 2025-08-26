<script src="https://unpkg.com/jsqr/dist/jsQR.js"></script>
<style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
        background: #f4f4f4;
    }

    #scanner-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    h4 {
        margin-bottom: 10px;
    }

    .instructions {
        font-size: 14px;
        color: #555;
        text-align: center;
        margin-bottom: 20px;
        max-width: 90%;
    }

    .scanner-frame {
        position: relative;
        width: 300px;
        height: 300px;
        border-radius: 10px;
        overflow: hidden;
        background: #000;
    }

    video#video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .frame-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80%;
        height: 80%;
        border: 2px dashed #fff;
        transform: translate(-50%, -50%);
        pointer-events: none;
        box-sizing: border-box;
    }

    .scan-status {
        margin-top: 30px;
        width: 300px;
        text-align: center;
    }

    .alert {
        padding: 10px;
        border-radius: 4px;
        margin: 0;
        font-size: 14px;
    }
</style>

<div class="card">
    <div class="card-body">
        <div id="scanner-container">
            <h4>Scan QR Code</h4>
            <p class="instructions">
                Place camera inside frame to scan. Please avoid shaking for fast and accurate result.
            </p>

            <div class="scanner-frame">
                <video id="video" autoplay playsinline></video>
                <div class="frame-overlay"></div>
            </div>

            <div class="scan-status">
                <p id="result-text" class="alert">
                    Scanning in progress...<br><small>Please wait</small>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Beep Sound -->
<audio id="beep-sound" src="assets/sound/beep.mp3" preload="auto"></audio>

<script>
    let video = document.getElementById('video');
    let resultText = document.getElementById('result-text');
    let beepSound = document.getElementById('beep-sound');
     let lastScanned = null;
    let scanningPaused = false; // 🔒 Control scanning flow

    // Start video
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
            video.srcObject = stream;
            video.setAttribute("playsinline", true);
            video.play();
            requestAnimationFrame(scanQRCode);
        })
        .catch(error => {
            console.error("Camera error: ", error);
            alert("Could not access the camera.");
        });

  

    function scanQRCode() {
        if (video.readyState === video.HAVE_ENOUGH_DATA && !scanningPaused) {
            let canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            let context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            let imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            let qrCode = jsQR(imageData.data, canvas.width, canvas.height);
            if (qrCode && qrCode.data !== lastScanned) {
                scanningPaused = true; // ⛔ pause scanning
                lastScanned = qrCode.data;
                beepSound.play();

                resultText.innerHTML = "QR Code Detected:<br><strong>" + qrCode.data + "</strong>";
                resultText.className = 'alert alert-warning';

                markAttendance(qrCode.data);
            }
        }

        requestAnimationFrame(scanQRCode);
    }

    function markAttendance(qrCodeData) {
        $.ajax({
            url: 'ajax.php?action=save_attendance',
            method: 'POST',
            data: {
                qr_data: qrCodeData,
                assistance_id: <?php echo (int) $_GET['assistance_id']; ?>
            },
            success: function (response) {
                if (response === 'success') {
                    resultText.innerHTML = "Attendance marked for:<br><strong>" + qrCodeData + "</strong>";
                    resultText.className = 'alert alert-success';
                } else if (response === 'already_marked') {
                    resultText.innerHTML = "Already marked today.";
                    resultText.className = 'alert alert-warning';
                } else if (response === 'not_found') {
                    resultText.innerHTML = "QR code not recognized.";
                    resultText.className = 'alert alert-danger';
                } else {
                    resultText.innerHTML = "Error: " + response;
                    resultText.className = 'alert alert-danger';
                }

                // ✅ Wait before resuming scanning
                setTimeout(() => {
                    lastScanned = null;
                    scanningPaused = false;
                    resultText.innerHTML = "Ready for next scan...";
                    resultText.className = 'alert';

               
                }, 2000);
            },
            error: function (xhr, status, error) {
                resultText.innerHTML = "❌ AJAX error: " + error;
                resultText.className = 'alert alert-danger';

                setTimeout(() => {
                    lastScanned = null;
                    scanningPaused = false;
                    resultText.innerHTML = "Ready for next scan...";
                    resultText.className = 'alert';
                }, 3000);
            }
        });
    }


</script>