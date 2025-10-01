<div class="card mt-4">
    <div class="card-header">
        <a href="" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add New</a>
        <button class="btn btn-warning btn-flat" id="printSelectedIds"><i class="fa fa-print"></i> Print ID</button>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="soloParentTable">
            <thead>
                <tr class="text-center">
                    <th><input type="checkbox" id="selectAllSolo"></th>
                    <th>QR Code</th>
                    <th>Application No.</th>
                    <th>ID No.</th>
                    <th>Status</th>
                    <th>Barangay</th>
                    <th>FullName</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Full Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $solo_sql = "
                    SELECT spa.*, 
                           CONCAT(spa.first_name, ' ', spa.middle_name, ' ', spa.last_name) AS full_name,
                           CONCAT(spa.barangay, ', ', spa.municipality, ', ', spa.province) AS address,
                           GROUP_CONCAT(CONCAT(c.name,'|',DATE_FORMAT(spa.birthdate, '%M %d, %Y'),'|',c.age,'|',c.relationship) SEPARATOR '||') AS children_data
                    FROM solo_parent_applications spa
                    LEFT JOIN solo_parent_children c ON spa.spa_id = c.application_id
                    GROUP BY spa.spa_id
                ";
                $query = $conn->query($solo_sql);
                while ($row = $query->fetch_assoc()):
                    $status_badge = $row['is_verified'] ? '<span class="badge badge-success">Registered</span>' : '<span class="badge badge-warning">Pending</span>';
                ?>
                <tr>
                    <td>
                        <input type="checkbox" class="select-user" 
                               data-spa-id="<?= $row['spa_id']; ?>"
                               data-applicationno="<?= $row['application_no']; ?>"
                               data-photo="<?= $row['photo_id']; ?>"
                               data-fullname="<?= strtoupper($row['full_name']); ?>"
                               data-gender="<?= $row['gender']; ?>"
                               data-civilstatus="<?= $row['civil_status']; ?>"
                               data-solo_parent_type="<?= $row['solo_parent_type']; ?>"
                               data-birthdate="<?= date('F j, Y', strtotime($row['birthdate'])); ?>"
                               data-age="<?= $row['age']; ?>"
                               data-address="<?= $row['address']; ?>"
                               data-barangay="<?= $row['barangay']; ?>"
                               data-children="<?= $row['children_data']; ?>"
                        >
                    </td>
                    <td>
                        <?= empty($row['qr_code']) ? '<span class="badge badge-warning">Pending</span>' : '<img class="img-fluid" src="assets/uploads/qrcodes/'.$row['qr_code'].'" alt="QR">'; ?>
                    </td>
                    <td><?= $row['application_no']; ?></td>
                    <td><?= empty($row['idCard_no']) ? '<span class="badge badge-warning">Pending</span>' : $row['idCard_no']; ?></td>
                    <td><?= $status_badge; ?></td>
                    <td><?= $row['barangay']; ?></td>
                    <td><?= strtoupper($row['full_name']); ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['civil_status']; ?></td>
                    <td><?= date('F j, Y', strtotime($row['birthdate'])); ?></td>
                    <td><?= $row['age']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td>
                        <a href="./index.php?page=view_solo_application&spa_id=<?= $row['spa_id']; ?>" class="btn btn-success text-white btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                        <a href="./index.php?page=edit_solo_application&spa_id=<?= $row['spa_id']; ?>" class="btn btn-lightblue text-white btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" data-id="<?= $row['spa_id']; ?>" class="delete_user btn btn-danger btn-sm btn-flat"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#soloParentTable').dataTable();


        $('.delete_user').click(function () {
            _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
        })

        function delete_user($id) {
            start_load()
            $.ajax({
                url: 'ajax.php?action=delete_soloparent_user',
                method: 'POST',
                data: { id: $id },
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully deleted", 'success')
                        setTimeout(function () {
                            location.reload()
                        }, 1500)

                    }
                }
            })
        }
    })
</script>
<script>
function printSoloParentID(data) {
    const win = window.open('', '', 'height=1000,width=1000');
    const css = `
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f8f8f8; }
        .card-pair { display: flex; justify-content: space-between; width: 700px; margin-bottom: 20px; }
        .id-card-print { width: 336px; height: 213px; border: 1px solid #000; position: relative; }
        @media print { .id-card-print.front, .id-card-print.back { -webkit-print-color-adjust: exact; print-color-adjust: exact; } }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 5px; border-bottom: 1px solid #000; }
        .logo { width: 50px; height: 50px; }
        .title { text-align: center; font-size: 10px; font-weight: bold; flex: 1; }
        .content { margin-left: 6px; display: flex; justify-content: space-between; padding: 5px; }
        .details { flex: 1; padding-right: 5px; font-size: 10px; }
        .details p { margin: 3px 0; }
        .profile-section { display: flex; flex-direction: column; align-items: center; width: 100px; }
        .profile-pic { width: 80px; height: 80px; background-color: #eee; border: 1px solid #000; overflow: hidden; }
        .profile-pic img { width: 100%; height: 100%; object-fit: cover; }
        .id-number-display { text-align: center; margin-top: 5px; }
        .id-number-display .number { border-bottom: 1px solid #000; font-weight: bold; font-size: 10px; display: inline-block; min-width: 70px; }
        .id-number-display .label { font-size: 8px; }
        .underline-name { display: inline-block; border-bottom: 1px solid #000; font-weight: bold; font-size: 12px; }
        .label-under-name { font-size: 8px; margin-top: 0; display: block; }
        .footer { text-align: center; margin-top: 5px; border-top: 1px solid #000; padding-top: 5px; font-size: 10px; }
        .id-card-print.front { background-image: url('assets/uploads/ID_background_1.png'); background-size: cover; background-repeat: no-repeat; background-position: center; }
        .id-card-print.back { background-image: url('assets/uploads/ID_background_1.png'); background-size: cover; background-repeat: no-repeat; background-position: center; }
        .back-content { margin: 8px; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; font-size: 9px; }
        th, td { border: 1px solid #000; padding: 2px; text-align: center; }
        .signature-container { display: flex; justify-content: space-between; font-size: 9px; margin-top: 5px; }
    </style>`;

    let allCards = data.map(d => {
        // Parse children from data-children
        let childrenRows = '';
        const children = d.children_string ? d.children_string.split('||') : [];
        children.forEach(c => {
            const parts = c.split('|');
            childrenRows += `<tr>
                                <td>${parts[0]}</td>
                                <td>${parts[1]}</td>
                                <td>${parts[2]}</td>
                                <td>${parts[3]}</td>
                             </tr>`;
        });

        // Ensure at least 3 rows
        for (let i = children.length; i < 3; i++) {
            childrenRows += `<tr><td colspan="4" style="height:30px;"></td></tr>`;
        }

        return `
        <div class="card-pair">
            <!-- FRONT -->
            <div class="id-card-print front">
                <div class="header">
                    <img src="assets/img/santa maria-seal.png" class="logo" alt="Logo">
                    <div class="title">
                        Republic of the Philippines<br>
                        Province of Isabela<br>
                        Municipality of Cabagan<br>
                        <strong>SOLO PARENT ID</strong>
                    </div>
                    <img src="assets/img/santa maria-seal.png" class="logo" alt="Logo">
                </div>
                <div class="content">
                    <div class="profile-section">
                        <div class="profile-pic">
                            ${d.photo ? `<img src="${d.photo}" alt="Profile">` : ''}
                        </div>
                        <div class="id-number-display">
                            <div class="number">${d.applicationNo}</div>
                            <div class="label">ID No.</div>
                        </div>
                    </div>
                    <div class="details">
                        <p><span class="underline-name">${d.fullName}</span><span class="label-under-name">Name</span></p>
                        <p><strong>Birthdate:</strong> ${d.birthdate}</p>
                        <p><strong>Age:</strong> ${d.age}</p>
                        <p><strong>Gender:</strong> ${d.gender}</p>
                        <p><strong>Category:</strong> ${d.solo_parent_type}</p>
                        <p><strong>Address:</strong> ${d.address}</p>
                    </div>
                </div>
                <div class="footer">Signature / Thumbprint of Solo Parent</div>
            </div>

            <!-- BACK -->
            <div class="id-card-print back">
                <div class="back-content">
                    <table>
                        <thead>
                            <tr>
                                <th>CHILD/REN/DEPENDENT/S</th>
                                <th>DATE OF BIRTH</th>
                                <th>AGE</th>
                                <th>RELATIONSHIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${childrenRows}
                        </tbody>
                    </table>

                    <p style="font-size:8px; margin-top:5px;">
                        <strong>IN CASE OF EMERGENCY:</strong><br>
                        Name: ____________________________________<br>
                        Contact Number: __________________________<br>
                        Address: _________________________________
                    </p>

                    <div class="signature-container">
                        <div style="text-align:center;">
                            HILARIO G. PAGAUITAN<br>
                            CITY/MUNICIPAL MAYOR
                        </div>
                        <div style="text-align:center;">
                            CONSORCIA A. VIERNES<br>
                            C/MSWDO HEAD
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }).join('');

    win.document.write(`<html><head><title>Print Solo Parent IDs</title>${css}</head><body>${allCards}</body></html>`);
    win.document.close();
    win.focus();
    setTimeout(() => { win.print(); win.close(); }, 500);
}

// Collect selected checkboxes
document.getElementById('printSelectedIds').addEventListener('click', function () {
    const selected = [];
    document.querySelectorAll('.select-user:checked').forEach(cb => {
        selected.push({
            spaId: cb.dataset.spaId,
            applicationNo: cb.dataset.applicationno,
            fullName: cb.dataset.fullname,
            birthdate: cb.dataset.birthdate,
            gender: cb.dataset.gender,
            solo_parent_type: cb.dataset.solo_parent_type,
            age: cb.dataset.age,
            address: cb.dataset.address,
            barangay: cb.dataset.barangay,
            photo: cb.dataset.photo,
            children_string: cb.dataset.children // <-- data-children from PHP
        });
    });

    if (selected.length === 0) {
        alert('Please select at least one solo parent.');
        return;
    }

    printSoloParentID(selected);
});


    // Optional: Select/Deselect all checkbox
    document.getElementById('selectAllSolo').addEventListener('change', function () {
        const isChecked = this.checked;
        document.querySelectorAll('.select-solo').forEach(cb => {
            cb.checked = isChecked;
        });
    });
</script>