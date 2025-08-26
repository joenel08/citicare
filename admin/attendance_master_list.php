<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #plain-table, #plain-table * {
        visibility: visible;
    }

    #plain-table {
        position: absolute;
        top: 0;
        left: 0;
    }

    button, .dataTables_wrapper, .card, .card-body {
        display: none !important;
    }
}
</style>

<?php
$aid = (int) $_GET['assistance_id'];

// Fetch Assistance Info
$assistance = $conn->query("SELECT * FROM assistance WHERE assistance_id = $aid")->fetch_assoc();

// Fetch Attendance with Senior Info
$attendance_sql = "
    SELECT 
        a.date_marked,
        s.first_name, s.middle_name, s.last_name,
        s.barangay, s.municipality, s.province,
        s.contact_no
    FROM attendance a
    JOIN senior_citizens s ON s.user_id = a.user_id
    WHERE a.assistance_id = $aid
    ORDER BY a.date_marked DESC
";
$attendance_result = $conn->query($attendance_sql);
?>

<div class="card mb-3">
    <div class="card-body">

        <div class="d-flex justify-content-between">
            <div class="left">
                <h4 class="card-title"><?= $assistance['assistance_type'] ?> Assistance</h4>
                <p class="card-text text-muted mb-1"><?= $assistance['assistance_description'] ?></p>
                <p class="card-text"><small class="text-info">Date Given: <?= $assistance['date_given'] ?></small></p>
            </div>
            <div class="right">
                <div class="mb-3">
                    <button onclick="window.print()" class="btn btn-primary btn-sm btn-flat">
                        <i class="fa fa-print"></i> Print
                    </button>
                    <button onclick="downloadPDF()" class="btn btn-danger btn-sm btn-flat">
                        <i class="fa fa-file-pdf"></i> Download PDF
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Attendance Masterlist</h5>
        <table class="table table-bordered table-striped" id="attendance-list">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Date Marked</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $attendance_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] ?></td>
                        <td><?= $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] ?></td>
                        <td><?= $row['contact_no'] ?></td>
                        <td><?= $row['date_marked'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="plain-table" style="display:none;">
    <h3><?= $assistance['assistance_type'] ?> Assistance - Attendance Masterlist</h3>
    <p><?= $assistance['assistance_description'] ?></p>
    <p>Date Given: <?= $assistance['date_given'] ?></p>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Date Marked</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // re-run the query
            $attendance_result = $conn->query($attendance_sql);
            while ($row = $attendance_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] ?></td>
                    <td><?= $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] ?></td>
                    <td><?= $row['contact_no'] ?></td>
                    <td><?= $row['date_marked'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function () {
        $('#attendance-list').DataTable();
    });
</script>
<script>
    function downloadPDF() {
        const element = document.getElementById("plain-table");
        element.style.display = 'block'; // Show it temporarily
        html2canvas(element).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            const pdf = new jspdf.jsPDF("p", "mm", "a4");
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
            pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
            pdf.save("attendance-masterlist.pdf");
            element.style.display = 'none'; // Hide again
        });
    }
</script>
