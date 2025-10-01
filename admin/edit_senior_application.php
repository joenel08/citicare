<?php
include 'db_connect.php';

$id = $_GET['sec_id'];
$query = $conn->query("SELECT * FROM senior_citizens WHERE sc_id = $id");
$row = $query->fetch_assoc();

$fullName = strtoupper($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
$address = $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];

function checkbox($checked)
{
    return $checked ? '☑' : '☐';
}

function healthChecked($status, $value)
{
    return $status === $value ? '☑' : '☐';
}
?>


<div class="card">
    <div class="card-body">
        <form action="" id="manage_user" method="POST" enctype="multipart/form-data">
            <div class="d-flex">
                <div class="form-group ">
                    <label for="">Application No.:</label>
                    <input type="text" disabled class="form-control" value="<?= $row['application_no'] ?>">
                </div>
                &nbsp;
                <div class="form-group">
                    <label for="">ID Card No.:</label>
                    <input type="text" disabled class="form-control" value="<?= $row['idCard_no'] ?>">
                </div>
            </div>
            <h5 class="mt-2">Personal Info</h5>
            <input type="hidden" name="sc_id" value="<?= $row['sc_id'] ?>">

            <div class="row">
                <div class="col-md-4 mb-3 form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="<?= htmlspecialchars($row['first_name']) ?>">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control"
                        value="<?= htmlspecialchars($row['middle_name']) ?>">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="<?= htmlspecialchars($row['last_name']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3 form-group">
                    <label for="birthdate">Date of Birth</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control"
                        value="<?= $row['birthdate'] ?>">
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control"
                        value="<?= htmlspecialchars($row['age']) ?>">
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3 form-group">
                    <label for="civil_status">Civil Status</label>
                    <select name="civil_status" id="civil_status" class="form-control">
                        <option <?= $row['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                        <option <?= $row['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                        <option <?= $row['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                        <option <?= $row['civil_status'] == 'Separated' ? 'selected' : '' ?>>Widowed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="education">Educational Attainment</label>

                    <select name="education" id="education" class="form-control">
                        <option <?= $row['education'] == 'Elementary' ? 'selected' : '' ?>>Elementary</option>
                        <option <?= $row['education'] == 'High School' ? 'selected' : '' ?>>High School</option>
                        <option <?= $row['education'] == 'College' ? 'selected' : '' ?>>College</option>
                        <option <?= $row['education'] == 'Post-Graduate' ? 'selected' : '' ?>>Post-Graduate</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" name="occupation" id="occupation" class="form-control"
                        value="<?= htmlspecialchars($row['occupation']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="place_of_birth">Place of Birth</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                        value="<?= htmlspecialchars($row['place_of_birth']) ?>">
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <label for="contact_no">Contact No.</label>
                    <input type="text" name="contact_no" id="contact_no" class="form-control"
                        value="<?= htmlspecialchars($row['contact_no']) ?>">
                </div>
            </div>

            <div class="mb-3 form-group">
                <label for="address">Complete Address</label>
                <div class="row">
                    <div class="col-sm">
                        <select name="barangay" class="form-control mb-2">
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


                            $current_barangay = $row['barangay'];

                            foreach ($barangays as $barangay) {
                                $selected = ($barangay === $current_barangay) ? 'selected' : '';

                                echo '<option value="' . htmlspecialchars($barangay) . '" ' . $selected . '>' . htmlspecialchars($barangay) . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-sm">
                        <input type="text" disabled name="municipality" placeholder="Municipality"
                            class="form-control mb-2" value="<?= htmlspecialchars($row['municipality']) ?>">

                    </div>
                    <div class="col-sm">
                        <input type="text" disabled name="province" placeholder="Province" class="form-control"
                            value="<?= htmlspecialchars($row['province']) ?>">
                    </div>
                </div>
            </div>

            <h5 class="mt-4">Emergency Contact</h5>
            <div class="row">
                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_name">Name</label>
                    <input type="text" name="emergency_name" id="emergency_name" class="form-control"
                        value="<?= htmlspecialchars($row['emergency_name']) ?>">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_contact">Contact No.</label>
                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control"
                        value="<?= htmlspecialchars($row['emergency_contact']) ?>">
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label for="emergency_relationship">Relationship</label>
                    <input type="text" name="emergency_relationship" id="emergency_relationship" class="form-control"
                        value="<?= htmlspecialchars($row['emergency_relationship']) ?>">
                </div>
            </div>

            <h5 class="mt-4">Other Details</h5>
            <div class="row">
                <div class="col">
                    <div class="form-group mb-3">
                        <!-- Social Pensioner -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="social_pensioner" id="pensioner"
                                value="1" <?= $row['social_pensioner'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pensioner">
                                Senior Citizen is Social Pensioner
                            </label>
                        </div>

                        <!-- Retiree with details -->
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" name="retiree" id="retiree" value="1"
                                <?= $row['retiree'] ? 'checked' : '' ?>>
                            <label class="form-check-label me-2" for="retiree">
                                Senior is a retiree (specify):
                            </label>

                        </div>
                        <input type="text" class="form-control form-control-sm w-100" placeholder="Details"
                            id="retireeDetails" name="retiree_desc"
                            value="<?= htmlspecialchars($row['retiree_desc'] ?? '') ?>">
                        <!-- GSIS/SSS/Vet. Pensioner -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_gsis" id="gsis" value="1"
                                <?= $row['is_gsis'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="gsis">
                                Senior is a GSIS/SSS/Vet. Pensioner
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group mb-3">
                        <label>Health Status</label><br>
                        <label><input type="radio" name="health_status" value="Physically Fit"
                                <?= $row['health_status'] == 'Physically Fit' ? 'checked' : '' ?>> Physically
                            Fit</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="Sickly/Frail"
                                <?= $row['health_status'] == 'Sickly/Frail' ? 'checked' : '' ?>>
                            Sickly/Frail</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="Bedridden"
                                <?= $row['health_status'] == 'Bedridden' ? 'checked' : '' ?>> Bedridden</label>&nbsp;&nbsp;
                        <label><input type="radio" name="health_status" value="PWD" <?= $row['health_status'] == 'PWD' ? 'checked' : '' ?>> PWD</label>
                    </div>
                </div>
            </div>


            <div class="d-flex">
                <div class="form-group mb-3">
                    <label for="photo_id">Photo ID</label>
                    <input class="form-control" type="file" name="photo_id" id="photo_id" accept="image/*"
                        onchange="previewImage(this, 'preview_photo_id')">
                    <div class="mt-2">
                        <img id="preview_photo_id" src="assets/uploads/<?= htmlspecialchars($row['photo_id'] ?? '') ?>"
                            alt="Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="birth_proof">Proof of Birth</label>
                    <input class="form-control" type="file" name="birth_proof" id="birth_proof" accept="image/*"
                        onchange="previewImage(this, 'preview_birth')">
                    <div class="mt-2">
                        <img id="preview_birth" src="assets/uploads/<?= htmlspecialchars($row['birth_proof'] ?? '') ?>"
                            alt="Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="residency_proof">Proof of Residency</label>
                    <input class="form-control" type="file" name="residency_proof" id="residency_proof" accept="image/*"
                        onchange="previewImage(this, 'preview_residency')">
                    <div class="mt-2">
                        <img id="preview_residency"
                            src="assets/uploads/<?= htmlspecialchars($row['residency_proof'] ?? '') ?>" alt="Preview"
                            style="max-width: 150px; max-height: 150px; border:1px solid #ccc; padding:4px;">
                    </div>
                </div>
            </div>



            <div class="text-left mt-3">
                
                <a href="javascript:void(0)" data-id="<?= $row['sc_id'] ?>"
                    class="update_senior btn btn-primary btn-flat">
                    <i class="fa fa-save"></i> Update
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
    $('.update_senior').click(function () {
    _conf("Are you sure to update this data?", "update_data", [$(this).attr('data-id')])
})

function update_data(id) {
    start_load();

    // Submit via AJAX directly, not bind
    var formData = new FormData($('#manage_user')[0]);

    $.ajax({
        url: 'ajax.php?action=update_senior',
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