<div class="card mt-4">
    <div class="card-header">
        <a href="" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add New</a>
       
        <button class="btn btn-warning btn-flat" id="printSelectedIds"><i class="fa fa-print"></i> Print
            ID</button>

    </div>
    <div class="card-body">
        <table class="table table-hover" id="soloParentTable">
            <thead>
                <tr class="text-center">
                    <th><input type="checkbox" name="" id=""></th>
                    <th>QR Code</th>
                    <th class="text-center">Application No.</th>
                    <th class="text-center">ID No.</th>

                    <th>Status</th>
                    <th class="text-center">Barangay</th>
                    <th class="text-center">FullName</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Civil Status</th>


                    <th class="text-center">Birthdate</th>
                    <th class="text-center">Age</th>

                    <th class="text-center">Full Address</th>

                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $solo_sql = "SELECT * FROM `solo_parent_applications`";
                $query = $conn->query($solo_sql);
                while ($row = $query->fetch_assoc()):
                    $full_name = strtoupper($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
                    $address = $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];
                    $status_badge = $row['is_verified'] ? '<span class="badge badge-success">Registered</span>' : '<span class="badge badge-warning">Pending</span>';
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="select-user" data-applicationno="<?= $row['spa_id']; ?>"
                                data-id-card-no="<?= $row['application_no']; ?>" data-photo="<?= $row['photo_id']; ?>"
                                data-fullname="<?= $full_name; ?>" data-gender="<?= $row['gender']; ?>"
                                data-civilstatus="<?= $row['civil_status']; ?>"
                                data-birthdate="<?= date('F j, Y', strtotime($row['birthdate'])); ?>"
                                data-age="<?= $row['age']; ?>" data-address="<?= $address; ?>"
                                data-qr_code="<?= $row['qr_code'] ?? ''; ?>" data-barangay="<?= $row['barangay']; ?>">
                        </td>
                        <td>
                            <?php
                            if (empty($row['qr_code'])) {
                                echo '<span class="badge badge-warning">Pending</span>';
                            } else {
                                echo '<img class="img-fluid" src="' . $row['qr_code'] . '" alt="">';
                            }
                            ?>
                        </td>
                        <td><?= $row['application_no']; ?></td>
                        <td><?php
                        if (empty($row['idCard_no']) || $row['idCard_no'] == Null) {
                            echo '<span class="badge badge-warning">Pending</span>';
                        } else {
                            echo $row['idCard_no'];
                        }
                        ; ?></td>
                        <td>
                            <?= $status_badge; ?>

                        </td>

                        <td><?= $row['barangay']; ?></td>
                        <td><?= $full_name; ?></td>
                        <td><?= $row['gender']; ?></td>
                        <td><?= $row['civil_status']; ?></td>
                        <td><?= date('F j, Y', strtotime($row['birthdate'])); ?></td>
                        <td><?= $row['age']; ?></td>
                        <td><?= $address; ?></td>
                        <td>
                            <a href="./index.php?page=view_solo_application&spa_id=<?= $row['spa_id']; ?>"
                                class="btn btn-success text-white btn-sm btn-flat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="./index.php?page=edit_solo_application&spa_id=<?= $row['spa_id']; ?>"
                                class="btn btn-lightblue text-white btn-sm btn-flat">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" data-id="<?= $row['spa_id']; ?>"
                                class="delete_user btn btn-danger btn-sm btn-flat">
                                <i class="fas fa-trash"></i>
                            </a>
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


        $('.delete_user').click(function(){
	_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
		
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_soloparent_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	})
</script>
<script>
    function printSoloParentID(data) {
        const win = window.open('', '', 'height=1000,width=800');
        const css = `
        <style>
            body { font-family: Arial, sans-serif; padding: 20px; background: #f0f0f0; }
            .id-card-print { width: 600px; border: 1px solid #000; padding: 20px; background-color: #fff; margin-bottom: 30px; }
            .header { text-align: center; border-bottom: 1px solid #000; margin-bottom: 15px; }
            .title { font-size: 16px; font-weight: bold; margin-top: 10px; }
            .content { display: flex; justify-content: space-between; }
            .profile-section { display: flex; flex-direction: column; align-items: center; }
            .profile-pic { width: 200px; height: 200px; background-color: #ccc; border: 1px solid #000; }
            .id-number-display { text-align: center; margin-top: 10px; }
            .id-number-display .number { border-bottom: 1px solid #000; font-weight: bold; font-size: 14px; display: inline-block; padding-bottom: 2px; min-width: 100px; }
            .id-number-display .label { font-size: 10px; margin-top: 2px; }
            .details { flex: 1; padding-left: 20px; }
            .details p { margin: 4px 0; font-size: 14px; }
            .underline-name { display: inline-block; border-bottom: 1px solid #000; font-weight: bold; font-size: 16px; padding-bottom: 2px; margin-bottom: 0; }
            .label-under-name { font-size: 10px; margin-top: 0; margin-bottom: 8px; }
            .footer { text-align: center; margin-top: 20px; border-top: 1px solid #000; padding-top: 10px; }
            .signature-box { margin-top: 20px; font-size: 12px; border-top: 1px solid #000; width: 200px; margin-left: auto; margin-right: auto; padding-top: 5px; }
        </style>`;

        let allCards = data.map(d => `
        <div class="id-card-print">
            <div class="header">
                <div class="title">
                    Republic of the Philippines<br>
                    Province of Isabela<br>
                    Municipality of Cabagan<br>
                    Barangay ${d.barangay}<br>
                    <strong>SOLO PARENT ID</strong>
                </div>
            </div>
            <div class="content">
                <div class="profile-section">
                    <div class="profile-pic"></div>
                    <div class="id-number-display">
                        <div class="number">${d.applicationNo}</div>
                        <div class="label">ID No.</div>
                    </div>
                </div>
                <div class="details">
                    <p>
                        <span class="underline-name">${d.fullName}</span><br>
                        <span class="label-under-name">Name</span>
                    </p>
                    <p><strong>Gender:</strong> ${d.gender}</p>
                    <p><strong>Civil Status:</strong> ${d.civilStatus}</p>
                    <p><strong>Date of Birth:</strong> ${d.birthdate}</p>
                    <p><strong>Age:</strong> ${d.age}</p>
                    <p><strong>Address:</strong> ${d.address}</p>
                </div>
            </div>
            <div class="footer">
                <div class="signature-box">Signature of Barangay Captain</div>
            </div>
        </div>
        `).join('');

        win.document.write(`<html><head><title>Print Solo Parent IDs</title>${css}</head><body>${allCards}</body></html>`);
        win.document.close();
        win.focus();
        setTimeout(() => {
            win.print();
            win.close();
        }, 500);
    }

    document.getElementById('printSoloParentIDs').addEventListener('click', function () {
        let selected = [];
        document.querySelectorAll('.select-solo:checked').forEach(cb => {
            selected.push({
                applicationNo: cb.dataset.applicationno,
                fullName: cb.dataset.fullname,
                gender: cb.dataset.gender,
                civilStatus: cb.dataset.civilstatus,
                birthdate: cb.dataset.birthdate,
                age: cb.dataset.age,
                address: cb.dataset.address,
                barangay: cb.dataset.barangay
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