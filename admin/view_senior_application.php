<?php
include 'db_connect.php';

$id = $_GET['id'];
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

<style>
    .print-form {
        width: 80%;
        margin: auto;
    }

    .position-relative {
        position: relative;
    }

    .photo-id-box {

        top: 0;
        left: 0;
        /* optional styling */
        border: 1px solid #000;
        padding: 10px;
        background: #fff;
        width: 150px;
    }


    .photo-box {
        border: 1px solid #000;
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .id-number {
        margin-top: 8px;
        font-size: 14px;
    }

    table.form-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        position: relative;
        /* allow absolute inside */
    }

    .form-table td,
    .form-table th {
        border: 1px solid #000;
        padding: 5px 8px;
        vertical-align: top;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .photo-cell {
        text-align: center;
        height: 120px;
    }

    .photo-box {
        border: 1px solid #000;
        width: 100px;
        height: 100px;
        margin: 0 auto 5px;
    }

    .checkbox-label {
        display: inline-block;
        margin-right: 15px;
    }

    .no-border {
        border: none !important;
    }
    .logo { margin-left: 20%; position: absolute; top: 0; left: 0; width:100px; height: 100px; margin-top: 30px;}
</style>


<div class="card">
    <div class="card-body">
        <div class="print-form">
            <div class="header">
                <img src="assets/img/santa maria-seal.png" class="logo" alt="Logo">
                <div class="">
                    <h6>Republic of the Philippines<br>Province of Isabela<br>Municipality of Santa Maria</h6>
                    <h6><strong>OFFICE OF SENIOR CITIZEN AFFAIRS</strong></h6>
                    <h5><strong>SENIOR CITIZEN ID APPLICATION FORM</strong></h5>
                </div>
                <hr>
            </div>
            <div class="position-relative">
                <div class="photo-id-box mb-3">
                    <div class="photo-box">
                        <img src="assets/uploads/<?= $row['photo_id'] ?>" alt="Photo" style="max-height:100%; max-width:100%;">
                    </div>
                    <div class="id-number mt-2">
                        <strong>ID Number:</strong>
                        <?php if (empty($row['idCard_no'])): ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php else: ?>
                            <?= htmlspecialchars($row['idCard_no']) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <table class="form-table">


                    <div class="d-flex justify-content-between mt-3 mb-3">
                        <div>
                            <strong>Application No.:</strong> <?= $row['application_no'] ?>
                        </div>

                        <div>
                            <strong>Date:</strong> <?= date("F j, Y", strtotime($row['date_registered'])) ?>
                        </div>

                    </div>
                    <tr>
                        <td>NAME:</td>
                        <td>
                            <?= $row['first_name'] ?>
                        </td>
                        <td>
                            <?= $row['middle_name'] ?>
                        </td>
                        <td>
                            <?= $row['last_name'] ?>
                        </td>
                    </tr>

                    <tr>
                        <td>

                        </td>
                        <td>
                            First Name
                        </td>
                        <td>
                            Middle Name
                        </td>
                        <td>
                            Last Name
                        </td>
                    </tr>

                    <tr>
                        <td>Date of Birth (MM-DD-YYYY)</td>
                        <td>Age</td>
                        <td>Gender</td>
                        <td>Civil Status</td>
                    </tr>
                    <tr>
                        <td><?= $row['birthdate'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['civil_status'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Educational Attainment: <?= $row['education'] ?></td>
                        <td colspan="2">Occupation: <?= $row['occupation'] ?></td>

                    </tr>

                    <tr>
                        <td colspan="2">Place of Birth: <?= $row['place_of_birth'] ?></td>
                        <td colspan="2">Occupation: <?= $row['contact_no'] ?></td>

                    </tr>
                    <tr>
                        <td colspan="4">Complete Address: <?= $address ?></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            In case of Emergency Please Notify: <br>
                            <strong>Name: </strong><?= $row['emergency_name'] ?> <br>
                            <strong>Contact No.: </strong><?= $row['emergency_contact'] ?> <br>
                            <strong>Relationship: </strong><?= $row['emergency_relationship'] ?>

                        </td>
                        <td colspan="2">
                            Please Check <br>
                            <?= checkbox($row['social_pensioner']) ?> Senior Citizen is social pensioner<br>
                            <?= checkbox($row['retiree']) ?> Senior is a retiree (<?= $row['retiree_desc'] ?>)<br>
                            <?= checkbox($row['is_gsis']) ?> Senior is a GSIS/SSS/Vet. Pensioner
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            Health Status: <br>
                            <div class="text-center">
                                <?= healthChecked($row['health_status'], 'Physically Fit') ?> Physically Fit
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?= healthChecked($row['health_status'], 'Sickly/Frail') ?> Sickly/Frail
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?= healthChecked($row['health_status'], 'Bedridden') ?> Bedridden
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?= healthChecked($row['health_status'], 'PWD') ?> PWD
                            </div>
                        </td>
                    </tr>
                </table>

                <label for="" class="mt-3">Attached Requirements:</label>
                <div class="row">
                    <div class="col">
                        <img class="img-fluid" src="assets/uploads/<?= $row['birth_proof'] ?>" alt="Photo">
                    </div>

                    <div class="col">
                        <img class="img-fluid" src="assets/uploads/<?= $row['residency_proof'] ?>" alt="Photo">
                    </div>
                </div>
            </div>


            <div class="text-right mt-3 no-print">
                <a href="./index.php?page=senior_citizens_list" class="btn btn-secondary btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
                <?php
                if ($row['is_verified'] == 1) { ?>
                    <a class="btn btn-danger btn-flat declineUser" href="javascript:void(0)"
                        data-id="<?php echo $row['sc_id'] ?>"><i class="fa fa-times"></i> Decline</a>

                <?php } else { ?>
                    <a class="btn btn-primary btn-flat acceptUser" href="javascript:void(0)"
                        data-id="<?php echo $row['sc_id'] ?>"><i class="fa fa-check"></i> Accept</a>
                <?php } ?>
                 <button onclick="window.print()" class="btn btn-success btn-flat"><i class="fa fa-print"></i> Print</button>
                 <button class="btn btn-info btn-flat"><i class="fa fa-file-pdf"></i> Download</button>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {

        $('.acceptUser').click(function () {

            _conf("Are you sure you want to approve this senior citizens application?", "approve_user", [$(this).attr('data-id')])
        })

    })
    function approve_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=approve_user',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Senior Citizens Application successfully approved!", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>