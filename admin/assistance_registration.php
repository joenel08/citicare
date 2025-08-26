<?php
// Sample dummy data for assistance (replace with actual data or database queries)
$categories = ['Senior Citizen', 'PWD', 'Solo Parent'];

?>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <!-- Form Registration in col-4 -->

                <h4>Assistance Registration</h4>
                <form id="assistanceForm">
                    <input type="hidden" name="assistance_id" value="">
                    <!-- Category -->
                    <div class="form-group mb-3">
                        <label for="category">Select Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="">-- Choose Category --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category ?>"><?= $category ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Assistance Type -->
                    <div class="form-group mb-3">
                        <label for="assistance_type">Select Assistance Type</label>
                        <select name="assistance_type" id="assistance_type" class="form-control" required>
                            <option value="">-- Choose Assistance Type --</option>
                            <option value="Financial">Financial Assistance</option>
                            <option value="Rice">Rice Assistance</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="assistance_type">Assistance Description</label>

                        <textarea id="" name="assistance_description" class="form-control"></textarea>
                    </div>
                    <!-- Date -->
                    <div class="form-group mb-3">
                        <label for="date">Date of Assistance</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-secondary btn-flat">Reset</button>
                        <button type="submit" class="btn btn-success btn-flat">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">


                <h3>Assistance List</h3>
                <table class="table table-bordered table-striped" id="list">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Assistance Type</th>
                            <th>Assistance Description</th>
                            <th>Date</th>
                            <th>Masterlist</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $assistance_sql = "SELECT * FROM assistance";

						$query = $conn->query($assistance_sql);
						while ($row = $query->fetch_assoc()):
						
							?>
                    
                            <tr>
                                <td><?= $row['category'] ?></td>
                                <td><?= $row['assistance_type'] ?></td>
                                <td><?= $row['assistance_description'] ?></td>

                                <td><?= $row['date_given'] ?></td>
                                <td><a href="./index.php?page=attendance_master_list&assistance_id=<?php echo $row['assistance_id'] ?>">View Masterlist</a>
                                </td>
                                <td><a href="./index.php?page=attendance_system&assistance_id=<?php echo $row['assistance_id'] ?>"
                                        class="btn btn-primary btn-flat">Attendance</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>




<script>
    $(document).ready(function () {
        $('#list').DataTable();
    });
    $('#assistanceForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'ajax.php?action=save_assistance',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.trim() === 'success') {
                    alert('Assistance successfully saved!');
                    $('#assistanceForm')[0].reset();
                } else {
                    alert('Error: ' + response);
                }
            },
            error: function () {
                alert('AJAX request failed.');
            }
        });
    });
</script>