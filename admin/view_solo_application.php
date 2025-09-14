<style>
    .solo-inputs {
        border-top: 0 !important;
        border-left: 0 !important;
        border-right: 0 !important;

    }

    .tabSpace {
        margin-left: 40px;
    }
    p.solo-inputs {
       text-decoration: underline;

    }
</style>

<div class="card">
    <div class="card-body">

        <div class="container">
            <div class="row text-center">
                <div class="col-3">
                    <img src="assets/img/santa maria-seal.png" class="img-fluid" width="100" alt="Logo">
                </div>
                <div class="col-sm">
                    <h6>Republic of the Philippines<br>Province of Isabela<br>Municipality of Santa Maria</h6>
                </div>
                <div class="col-3">
                    <img src="assets/img/santa maria-seal.png" class="img-fluid" width="100" alt="Logo">

                </div>
            </div>


            <h6 class="text-center"><strong>MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</strong></h6>
            <h6 class="text-center"><strong>APPLICATION FORM FOR SOLO PARENT</strong></h6>
            <hr>
            
<?php

$spa_id = (int) $_GET['spa_id'];

// Parent Info
$sql_parent = "
    SELECT spa.*, u.*
    FROM solo_parent_applications spa
    LEFT JOIN users u ON spa.user_id = u.id
    WHERE spa.spa_id = ?
";
$stmt_parent = mysqli_prepare($conn, $sql_parent);
mysqli_stmt_bind_param($stmt_parent, "i", $spa_id);
mysqli_stmt_execute($stmt_parent);
$result_parent = mysqli_stmt_get_result($stmt_parent);
$parent_info = mysqli_fetch_assoc($result_parent);

// Children Info
$result_children = null;
if ($parent_info) {
    $application_id = $parent_info['spa_id'];
    $sql_children = "SELECT * FROM solo_parent_children WHERE application_id = ?";
    $stmt_children = mysqli_prepare($conn, $sql_children);
    mysqli_stmt_bind_param($stmt_children, "i", $application_id);
    mysqli_stmt_execute($stmt_children);
    $result_children = mysqli_stmt_get_result($stmt_children);

    // mysqli_stmt_close($stmt_children);
}
// mysqli_stmt_close($stmt_parent);


?>

<div class="container mt-5">
    <label class="" for="pantawid">Application Type</label>
    <div class="d-flex align-items-center gap-2">
        <div class="form-group form-check mr-3">
            <input type="checkbox" class="form-check-input" id="new"
                <?php echo ($parent_info['application_type'] == 1) ? 'checked' : ''; ?>>
            <label class="" for="new">New Applicant</label>
        </div>
        <div class="form-group form-check mr-3">
            <input type="checkbox" class="form-check-input" id="renew"
                <?php echo ($parent_info['application_type'] == 2) ? 'checked' : ''; ?>>
            <label class="" for="renew">Renewal</label>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <p class="m-0 p-0"><strong><u>I. IDENTIFYING INFORMATION:</u></strong></p>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <label for="">Name:</label>
        <input type="text" name="" id="" class="solo-inputs" style="width:100%"
            value="<?php echo htmlspecialchars($parent_info['first_name'] . ' ' . $parent_info['middle_name'] . ' ' . $parent_info['last_name'] . ' ' . $parent_info['extension_name']); ?>">
    </div>

    <div class="row g-2">
        <div class="col-md-3 d-flex align-items-center">
            <label for="" class="me-2 mb-0">Age:</label>
            <input type="text" class="solo-inputs"
                value="<?php echo htmlspecialchars($parent_info['age']); ?>">
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <label for="" class="me-2 mb-0">Date of Birth:</label>
            <input type="text" class="solo-inputs"
                value="<?php echo htmlspecialchars($parent_info['birthdate']); ?>">
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <label for="" class="me-2 mb-0">Sex:</label>
            <input type="text" class="solo-inputs"
                value="<?php echo htmlspecialchars($parent_info['gender']); ?>">
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <label for="" class="me-2 mb-0">Civil Status:</label>
            <input type="text" class="solo-inputs"
                value="<?php echo htmlspecialchars($parent_info['civil_status']); ?>">
        </div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <label for="" class="mb-0">Complete Address:</label>
        <input type="text" class="solo-inputs flex-grow-1"
            value="<?php echo htmlspecialchars($parent_info['barangay'] . ', ' . $parent_info['municipality'] . ', ' . $parent_info['province']); ?>">
       
    </div>

    <div class="d-flex align-items-center gap-2">
        <label for="" class="mb-0">Highest Educational Attainment:</label>
        <input type="text" class="solo-inputs flex-grow-1"
            value="<?php echo htmlspecialchars($parent_info['education']); ?>">
        <label for="" class="mb-0">Occupation:</label>
        <input type="text" class="solo-inputs flex-grow-1" value="<?php echo htmlspecialchars($parent_info['occupation']); ?>">
    </div>
    <div class="d-flex align-items-center gap-2">
        <label for="" class="mb-0">Religion:</label>
        <input type="text" class="solo-inputs flex-grow-1"
            value="<?php echo htmlspecialchars($parent_info['religion']); ?>">
        <label for="" class="mb-0">Monthly Income:</label>
        <input type="text" class="solo-inputs flex-grow-1"
            value="<?php echo htmlspecialchars($parent_info['monthly_income']); ?>">
    </div>

    <div class="d-flex align-items-center gap-2">
        <label for="" class="mb-0">Contact No.:</label>
        <input type="text" class="solo-inputs flex-grow-1" value="<?php echo htmlspecialchars($parent_info['contact_info']); ?>">
        <label for="" class="mb-0">Email Address:</label>
        <input type="text" class="solo-inputs flex-grow-1"
            value="<?php echo htmlspecialchars($parent_info['email']); ?>">
    </div>

    <div class="d-flex align-items-center gap-2">
        <div class="form-group form-check mr-3">
            <input type="checkbox" class="form-check-input" id="pantawid-beneficiary"
                <?php echo ($parent_info['pantawid_beneficiary'] == 1) ? 'checked' : ''; ?>>
            <label class="" for="pantawid-beneficiary">Pantawid Beneficiary</label>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="m-0 p-0"><strong><u>Family Composition (Children Only)</u></strong></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Relationship</th>
                        <th>With Disability (Yes/No)</th>
                        <th>Educational Attainment</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the children data and display each row
                    if (isset($result_children)) {
                        while ($child = mysqli_fetch_assoc($result_children)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($child['name']); ?></td>
                                <td><?php echo htmlspecialchars($child['age']); ?></td>
                                <td><?php echo htmlspecialchars($child['relationship']); ?></td>
                                <td><?php echo ($child['disability'] == 1) ? 'Yes' : 'No'; ?></td>
                                <td><?php echo htmlspecialchars($child['education']); ?></td>
                                <td><?php echo htmlspecialchars($child['occupation']); ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="m-0 p-0"><strong><u>II. CLASSIFICATION/CIRCUMSTANCES OF BEING A SOLO PARENT:</u></strong></p>
        </div>
    </div>

    <div class="row w-50 tabSpace mt-3">
        <div class="col">
            <div class="row">
                <label for="" class="mb-0">- Unwed/Unmarried Since:</label>
                <input type="text" class="solo-inputs flex-grow-1"
                    value="<?php echo htmlspecialchars($parent_info['solo_parent_type'] == 'Unwed/Unmarried' ? $parent_info['solo_parent_since'] : ''); ?>">
            </div>
            <div class="row">
                <label for="" class="mb-0">- Separated/Annuled Since:</label>
                <input type="text" class="solo-inputs flex-grow-1"
                    value="<?php echo htmlspecialchars($parent_info['solo_parent_type'] == 'Separated/Annuled' ? $parent_info['solo_parent_since'] : ''); ?>">
            </div>
            <div class="row">
                <label for="" class="mb-0">- Widow/er Since:</label>
                <input type="text" class="solo-inputs flex-grow-1"
                    value="<?php echo htmlspecialchars($parent_info['solo_parent_type'] == 'Widow/er' ? $parent_info['solo_parent_since'] : ''); ?>">
            </div>
            <div class="row">
                <label for="" class="mb-0">Others:</label>
                <input type="text" class="solo-inputs flex-grow-1"
                    value="<?php echo htmlspecialchars($parent_info['other_classification']); ?>">
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <p class="m-0 p-0"><strong><u>III. NEEDS/PROBLEMS OF SOLO PARENT:</u></strong></p>
            <p class="solo-inputs"><?php echo htmlspecialchars($parent_info['needs_problems']); ?></p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <p class="m-0 p-0"><strong><u>IV. FAMILY RESOURCES:</u></strong></p>
            <p class="solo-inputs"><?php echo htmlspecialchars($parent_info['family_resources']); ?></p>
        </div>
    </div>
</div>


<div class="row">
<div class="col">
    <p><i>
I hereby certify that the information given above are true and correct. I further understand that any misinterpretation may will subject me to criminal and civil liabilities provided for by existing laws.</i></p>

</div>    
</div>
  <div class="text-right mt-3 no-print">
                <a href="./index.php?page=solo_parent_list" class="btn btn-secondary btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
                <?php
                if ($parent_info['is_verified'] == 1) { ?>
                    <a class="btn btn-danger btn-flat declineUser" href="javascript:void(0)"
                        data-id="<?php echo $parent_info['spa_id'] ?>"><i class="fa fa-times"></i> Decline</a>

                <?php } else { ?>
                    <a class="btn btn-primary btn-flat acceptUser" href="javascript:void(0)"
                        data-id="<?php echo $parent_info['spa_id'] ?>"><i class="fa fa-check"></i> Accept</a>
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

            _conf("Are you sure you want to approve this solo parent application? ", "approve_user", [$(this).attr('data-id')])
        })

    })
    function approve_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=approve_user_solo',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Solo Parent Application successfully approved!", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>