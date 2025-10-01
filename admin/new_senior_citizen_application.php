<?php
include 'db_connect.php';

?>


<div class="card">
    <div class="card-body">
        <form action="" id="manage_user" method="POST" enctype="multipart/form-data">

            <h5 class="mt-2">Personal Info</h5>
            <input type="hidden" name="sc_id">

            <div class="row">
                <div class="col-md-4 mb-3 form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3 form-group">
                    <label for="birthdate">Date of Birth</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control">
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control">
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="civil_status">Civil Status</label>
                    <select name="civil_status" id="civil_status" class="form-control" required>
                        <option value="" disabled selected>-- Select Civil Status --</option>

                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="education">Educational Attainment</label>

                    <select name="education" id="education" class="form-control" required>
                        <option value="" disabled selected>-- Select Educational Attainment --</option>

                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                        <option value="College">College</option>
                        <option value="Post-Graduate">Post-Graduate</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" name="occupation" id="occupation" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="place_of_birth">Place of Birth</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <label for="contact_no">Contact No.</label>
                    <input type="text" name="contact_no" id="contact_no" class="form-control">
                </div>
            </div>

            <div class="mb-3 form-group">
                <label for="address">Complete Address</label>
                <div class="row">
                    <div class="col-sm">
                        <select name="barangay" class="form-control mb-2" required>
                            <option value="" disabled selected>-- Select a Barangay --</option>
                            <?php
                            // Define the list of barangays
                            $barangays = [
                                "Bangad",
                                "Buenavista",
                                "Calamagui North",
                                "Calamagui East",
                                "Calamagui West",
                                "Divisoria",
                                "Lingaling",
                                "Mozzozzin Sur",
                                "Mozzozzin North",
                                "Naganacan",
                                "Poblacion 1",
                                "Poblacion 2",
                                "Poblacion 3",
                                "Quinagabian",
                                "San Antonio",
                                "San Isidro East",
                                "San Isidro West",
                                "San Rafael West",
                                "San Rafael East",
                                "Villabuena"
                            ];


                            foreach ($barangays as $barangay) {

                                echo '<option value="' . htmlspecialchars($barangay) . '">' . htmlspecialchars($barangay) . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-sm">
                        <input type="text" disabled name="municipality" placeholder="Municipality"
                            class="form-control mb-2" value="Santa Maria">

                    </div>
                    <div class="col-sm">
                        <input type="text" disabled name="province" placeholder="Province" class="form-control"
                            value="Isabela">
                    </div>
                </div>
            </div>

            <h5 class="mt-4">Emergency Contact</h5>
            <div class="row">
                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_name">Name</label>
                    <input type="text" name="emergency_name" id="emergency_name" class="form-control">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_contact">Contact No.</label>
                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_relationship">Relationship</label>
                    <input type="text" name="emergency_relationship" id="emergency_relationship" class="form-control">
                </div>
            </div>

            <h5 class="mt-4">Other Details</h5>
            <div class="row">
                <div class="col">
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="social_pensioner" id="pensioner"
                                value="1">
                            <label class="form-check-label" for="pensioner">
                                Senior Citizen is Social Pensioner
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" name="retiree" id="retiree" value="1">
                            <label class="form-check-label me-2" for="retiree">
                                Senior is a retiree (specify):
                            </label>
                        </div>
                        <input type="text" class="form-control form-control-sm w-100" placeholder="Details"
                            id="retireeDetails" name="retiree_desc" value="">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_gsis" id="gsis" value="1">
                            <label class="form-check-label" for="gsis">
                                Senior is a GSIS/SSS/Vet. Pensioner
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group mb-3">
                        <label>Health Status</label><br>
                        <label><input type="radio" name="health_status" value="Physically Fit"> Physically
                            Fit</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="Sickly/Frail">
                            Sickly/Frail</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="Bedridden"> Bedridden</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="PWD"> PWD</label>
                    </div>
                </div>
            </div>


            <div class="d-flex">
                <div class="form-group mb-3">
                    <label for="photo_id">Photo ID</label>

                    <video id="cameraFeed" width="320" height="240" autoplay
                        style="border: 1px solid #ccc; display: block;"></video>

                    <button type="button" id="captureButton" class="btn btn-info mt-2">Take Photo</button>

                    <canvas id="photoCanvas" style="display: none;"></canvas>

                    <input type="hidden" name="photo_id_data" id="photo_id_data">

                    <div class="mt-2">
                        <img id="preview_photo_id" src="" alt="Captured Photo Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px; display: none;">
                    </div>

                    <label class="mt-2">Or Upload a File:</label>
                    <input class="form-control" type="file" name="photo_id_file" id="photo_id_file" accept="image/*"
                        onchange="previewImage(this, 'preview_photo_id')">

                </div>

                <div class="form-group mb-3">
                    <label for="birth_proof">Proof of Birth</label>
                    <input class="form-control" type="file" name="birth_proof" id="birth_proof" accept="image/*"
                        onchange="previewImage(this, 'preview_birth')">
                    <div class="mt-2">
                        <img id="preview_birth" src="" alt="Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="residency_proof">Proof of Residency</label>
                    <input class="form-control" type="file" name="residency_proof" id="residency_proof" accept="image/*"
                        onchange="previewImage(this, 'preview_residency')">
                    <div class="mt-2">
                        <img id="preview_residency" src="" alt="Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px;">
                    </div>
                </div>
            </div>

            <div class="text-left mt-3">

                <a href="javascript:void(0)" class="save_senior btn btn-primary btn-flat">
                    <i class="fa fa-save"></i> Save
                </a>
                <a href="./index.php?page=senior_citizens_list" class="btn btn-secondary btn-flat"><i
                        class="fa fa-arrow-left"></i> Back</a>
            </div>
        </form>

    </div>
</div>


<script>
    function previewImage(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    // Get all necessary elements
    const video = document.getElementById('cameraFeed');
    const canvas = document.getElementById('photoCanvas');
    const captureButton = document.getElementById('captureButton');
    const photoDataInput = document.getElementById('photo_id_data');
    const previewImageElement = document.getElementById('preview_photo_id');

    // Start the camera stream
    function startCamera() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    // Attach the stream to the video element
                    video.srcObject = stream;
                    video.style.display = 'block';
                })
                .catch(function (error) {
                    console.error("Could not access camera: ", error);
                    alert("Camera access denied or failed. Please upload a file instead.");
                });
        } else {
            alert("Your browser does not support camera access via getUserMedia.");
        }
    }

    // Capture the photo from the video stream
    captureButton.addEventListener('click', function () {
        if (video.srcObject) {
            // Set canvas dimensions to match the video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the current video frame onto the canvas
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas content to a data URL (Base64 image data)
            const imageDataURL = canvas.toDataURL('image/jpeg', 0.9); // 0.9 is quality

            // Stop the camera stream after capture
            video.srcObject.getTracks().forEach(track => track.stop());
            video.style.display = 'none'; // Hide the video feed

            // Put the image data into the hidden form input
            photoDataInput.value = imageDataURL;

            // Update the preview image
            previewImageElement.src = imageDataURL;
            previewImageElement.style.display = 'block';

            alert("Photo captured successfully!");
        } else {
            alert("Camera not started. Please ensure camera access is granted.");
        }
    });

    // Start the camera when the page loads
    window.onload = startCamera;
</script>

<script>
    $('.save_senior').click(function () {
        _conf("Are you sure to save this data?", "save_data")
    })

    function save_data() {
        start_load();

        // Submit via AJAX directly, not bind
        var formData = new FormData($('#manage_user')[0]);

        $.ajax({
            url: 'ajax.php?action=save_senior',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function (resp) {
                if (resp == 1) {
                    alert_toast('Data successfully saved.', "success");
                    setTimeout(function () {
                        location.replace('index.php?page=senior_citizens_list')
                    }, 750)
                } else if (resp == 2) {
                    $('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
                    $('[name="email"]').addClass("border-danger")
                    end_load()
                } else {
                    console.log(resp); // for debugging if not 1 or 2
                    end_load();
                }
            }
        })
    }

</script>