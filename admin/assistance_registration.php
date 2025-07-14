<?php
// Sample dummy data for assistance (replace with actual data or database queries)
$categories = ['Senior Citizen', 'PWD', 'Solo Parent'];
$assistance_data = [
    ['category' => 'Senior Citizen', 'assistance_type' => 'Financial', 'date' => '2023-04-25', 'attendance' => 'Present'],
    ['category' => 'PWD', 'assistance_type' => 'Rice', 'date' => '2023-04-20', 'attendance' => 'Absent'],
    ['category' => 'Solo Parent', 'assistance_type' => 'Financial', 'date' => '2023-03-10', 'attendance' => 'Present'],
    ['category' => 'Senior Citizen', 'assistance_type' => 'Rice', 'date' => '2023-05-14', 'attendance' => 'Present'],
    ['category' => 'PWD', 'assistance_type' => 'Financial', 'date' => '2023-06-02', 'attendance' => 'Absent'],
];
?>

<div class="card">
    <div class="card-body">
        <div class="container mt-5">
            <div class="row">
                <!-- Form Registration in col-4 -->
                <div class="col-md-4">
                    <h3>Assistance Registration</h3>
                    <form action="assistance_page.php" method="POST" class="p-4 border rounded shadow-sm bg-white">
                        
                        <!-- Category Selection -->
                        <div class="form-group mb-3">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">-- Choose Category --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category ?>"><?= $category ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Assistance Type Selection (Financial or Rice) -->
                        <div class="form-group mb-3">
                            <label for="assistance_type">Select Assistance Type</label>
                            <select name="assistance_type" id="assistance_type" class="form-control" required>
                                <option value="">-- Choose Assistance Type --</option>
                                <option value="Financial">Financial Assistance</option>
                                <option value="Rice">Rice Assistance</option>
                            </select>
                        </div>

                        <!-- Date of Assistance -->
                        <div class="form-group mb-3">
                            <label for="date">Date of Assistance</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>

                <!-- Assistance List in col-8 -->
                <div class="col-md-8">
                    <h3>Assistance List</h3>
                    <table class="table table-bordered table-striped" id="list">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Assistance Type</th>
                                <th>Date</th>
                                <th>Masterlist</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assistance_data as $data): ?>
                                <tr>
                                    <td><?= $data['category'] ?></td>
                                    <td><?= $data['assistance_type'] ?></td>
                                    <td><?= $data['date'] ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#masterlistModal">View Masterlist</a></td>
                                    <td><a href="./index.php?page=attendance_system" class="btn btn-primary btn-flat">Attendance</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Masterlist Modal -->
<div class="modal fade" id="masterlistModal" tabindex="-1" aria-labelledby="masterlistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masterlistModalLabel">Attendance Masterlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Attended Users:</h4>
                <ul>
                    <!-- Example dummy data of attended users -->
                    <li>John Doe (Senior Citizen) - Present</li>
                    <li>Jane Smith (PWD) - Present</li>
                    <li>Mark Johnson (Solo Parent) - Present</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="window.print();">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#list').DataTable();
    });
</script>
