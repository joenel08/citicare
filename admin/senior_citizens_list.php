<div class="row">


	<div class="col-sm">
		<div class="card">
			<div class="card-header">
				<a href="" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add New</a>
				<button class="btn btn-info btn-flat"><i class="fa fa-file-excel"></i> Download</button>
				<button class="btn btn-warning btn-flat" id="printSelectedIds"><i class="fa fa-print"></i> Print
					ID</button>

			</div>
			<div class="card-body">
				<!-- <h4 class="text1-lightblue font-weight-bold">Subject List</h4> -->
				<!-- <div class="lignblue"></div> -->
				<br>
				<table class="table table-hover" id="list">

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
						include 'db_connect.php'; // Make sure this file connects to your database
						
						$senior_sql = "SELECT * FROM `senior_citizens`";

						$query = $conn->query($senior_sql);
						while ($row = $query->fetch_assoc()):
							$full_name = strtoupper($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
							$address = $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];
							$status_badge = $row['is_verified'] ? '<span class="badge badge-success">Registered</span>' : '<span class="badge badge-warning">Pending</span>';
							?>
							<tr>
								<td>
									<input type="checkbox" class="select-user"
										data-applicationno="<?= $row['application_no']; ?>"
										data-id-card-no="<?= $row['idCard_no']; ?>" data-photo="<?= $row['photo_id']; ?>"
										data-fullname="<?= $full_name; ?>" data-gender="<?= $row['gender']; ?>"
										data-civilstatus="<?= $row['civil_status']; ?>"
										data-birthdate="<?= date('F j, Y', strtotime($row['birthdate'])); ?>"
										data-age="<?= $row['age']; ?>" data-address="<?= $address; ?>"
										data-qr_code="<?= $row['qr_code']; ?>" data-barangay="<?= $row['barangay']; ?>">
								</td>
								<td><?php
								if (empty($row['qr_code']) || $row['qr_code'] == Null) {
									echo '<span class="badge badge-warning">Pending</span>';
								} else {
									echo '<img class="img-fluid" src="' . $row['qr_code'] . '" alt="">';
								}
								; ?></td>

								<td><?= $row['application_no'];

								; ?></td>
								<td><?php
								if (empty($row['idCard_no']) || $row['idCard_no'] == Null) {
									echo '<span class="badge badge-warning">Pending</span>';
								} else {
									echo $row['idCard_no'];
								}
								; ?></td>
								<td>
									<?= $status_badge; ?>
									<!-- <button class="btn btn-sm btn-flat btn-primary">Print</button> -->
								</td>
								<td><?= $row['barangay']; ?></td>
								<td><?= $full_name; ?></td>
								<td><?= $row['gender']; ?></td>
								<td><?= $row['civil_status']; ?></td>
								<td><?= date('F j, Y', strtotime($row['birthdate'])); ?></td>
								<td><?= $row['age']; ?></td>
								<td><?= $address; ?></td>
								<td>
									<a href="./index.php?page=view_senior_application&id=<?= $row['sc_id']; ?>"
										class="btn btn-success text-white btn-sm btn-flat">
										<i class="fas fa-eye"></i>
									</a>
									<a href="./index.php?page=edit_user&sec_id=<?= $row['sc_id']; ?>"
										class="btn btn-lightblue text-white btn-sm btn-flat">
										<i class="fas fa-edit"></i>
									</a>
									<a href="javascript:void(0)" data-id="<?= $row['sc_id']; ?>"
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
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#manage-subject").on('submit', function (event) {
			event.preventDefault();

			var form_data = new FormData(this); // Use 'this' to refer to the form element
			start_load()
			$.ajax({
				url: "ajax.php?action=save_subject",
				type: "POST",
				data: form_data,
				processData: false, // Do not process the data
				contentType: false, // Do not set contentType
				success: function (resp) {
					// console.log(resp);
					if (resp == 1) {
						alert_toast("Data successfully saved", 'success')
						setTimeout(function () {
							location.reload()
						}, 1500)
					} else {
						alert_toast("Subject is in the list", 'error')
						setTimeout(function () {
							location.reload()
						}, 1500)
					}
				}
			});
		});
	});

</script>
<script>
	$(document).ready(function () {
		$('#list').dataTable()
	})
</script>

<script>
	function printSeniorID(data) {
		const win = window.open('', '', 'height=1000,width=800');
		const css = `
		<style>
			body { font-family: Arial, sans-serif; padding: 20px; background: #f8f8f8; }
		.card-pair {
  display: flex;
  justify-content: space-between;
  width: 700px;
  margin-bottom: 20px;
}
.id-card-print {
  width: 336px;
  height: 213px;
  border: 1px solid #000;
}


			.header { text-align: center; border-bottom: 1px solid #000; margin-bottom: 15px; position: relative; }
			.logo { margin-left: 30px; position: absolute; top: 0; left: 0; width:50px; height: 50px; }
			.qr{ margin-right: 10px;position: absolute; top: 0; right: 0; width:50px; height: 50px; }
			.title { font-size: 10px; font-weight: bold; margin-top: 10px; }
			.content { margin-left: 6px; display: flex; justify-content: space-between; }
			.details { flex: 1; padding-right: 20px; }
			.details p { margin: 4px 0; font-size: 12px; }
			.profile-section { display: flex; flex-direction: column; align-items: center; width: 120px; }
			.profile-pic { width: 80px; height: 80px; background-color: #eee; border: 1px solid #000; }
			.profile-pic img { width: 100%; height: 100%; object-fit: cover; }
			.id-number-display { text-align: center; margin-top: 10px; }
			.id-number-display .number { border-bottom: 1px solid #000; font-weight: bold; font-size: 12px; display: inline-block; padding-bottom: 2px; min-width: 100px; }
			.id-number-display .label { font-size: 8px; margin-top: 2px; }
			.underline-name { display: inline-block; border-bottom: 1px solid #000; font-weight: bold; font-size: 12px; padding-bottom: 2px; margin-bottom: 0; }
			.label-under-name { font-size: 10px; margin-top: 0; margin-bottom: 8px; }
			.footer { text-align: center; margin-top: 20px; border-top: 1px solid #000; padding-top: 10px; }
			.signature-box { margin-top: 20px; font-size: 12px; border-top: 1px solid #000; width: 200px; margin-left: auto; margin-right: auto; padding-top: 5px; }
		
		.detail-row { margin: 5px 0; }
			.underline { border-bottom: 1px solid #000; display: inline-block; min-width: 150px; padding: 2px 4px; }

			/* BACK */
			.back-content { margin: 8px;}
			.texts{text-align: center;}
			.back-title { font-size: 10px; text-align: center; font-weight: bold; margin-bottom: 10px; }
			.text-box { font-size: 8px; line-height: 1.6; margin-bottom: 10px;}
			.signature-box { font-size: 10px;border-top: 1px solid #000; width: 150px; text-align: center;margin: 0px; }
		
			.qr-code { text-align: center; margin-top: 10px; }
			.qr-code img { width: 100px; height: 100px; }
			.signature{text-align: center; font-size: 10px; margin: 0px;}
			.signature-container {
				display: flex;
				justify-content: space-between;
				font-size: 10px;
				}
			</style>`;

		let allCards = data.map(d => `
		<div class="card-pair">
		<div class="id-card-print front">
			<div class="header">
				<img src="assets/img/santa maria-seal.png" class="logo" alt="Logo">
				<div class="title">
					Republic of the Philippines<br>
					Province of Isabela<br>
					Municipality of Cabagan<br><br>
					
					<strong>SENIOR CITIZEN ID</strong>
				</div>
				${d.qr_code ? `
				
					<img src="${d.qr_code}" class="qr img-fluid" alt="QR Code">
				` : ''}
				
			</div>
			<div class="content">
				<div class="details">
					<p>
						<span class="underline-name">${d.fullName}</span><br>
						<span class="label-under-name">Name</span>
					</p>
					
				
					<p><strong>Date of Birth:</strong> ${d.birthdate}</p>
				
					<p><strong>Address:</strong> ${d.address}</p>
					<div class="signature-box">Signature / Thumbmark</div>
				</div>
				<div class="profile-section">
					<div class="profile-pic">
						<img src="${d.photo}" alt="Profile">
					</div>
					<div class="id-number-display">
						<div class="number">${d.idCard_no ?? 'PENDING'}</div>
						<div class="label">ID No.</div>
					</div>
				</div>
			</div>
			


			
		</div>
		<div class="id-card-print back">
		<!-- BACK -->
			<div class="back-content">
				<div class="back-title">BENEFITS AND PRIVILEGES UNDER REPUBLIC ACT NO. 9257</div>
				<div class="text-box">
					- Free medical/dental, diagnostic & laboratory fees in all government facilities.<br>
					- 20% discount on purchase of medicines. <br>
					- 20% discount in Hotels, Restaurants, Recreation Centers & Funeral Parlors. 20% discounts on theaters, cinema houses and concert halls, etc. <br>
					- 20% discounts on medical & dental services, diagnostic & laboratory fees in private facilities.<br>
					- 20% discounts in fare for domestic air, sea travel and public land transpoon.<br>

					<p class="texts">Only for the exclusive use of Senior Citizens of privileges is punishable by law. <br>
					Persons and Corporations violating RA 9257 shall be penalized</p>

				</div>
				<br>
				<div class="signature-container">
				<div class="signature">
					Rosario P. Canceran
					<div class="signature-box">OSCA Head</div>
				</div>
				<div class="signature">
					Hilario G. Pagauitan
					<div class="signature-box">Municipal Mayor</div>
				</div>
				</div>

				
				
			</div>
		</div>
		</div>
	`).join('');

		win.document.write(`<html><head><title>Print ID Cards</title>${css}</head><body>${allCards}</body></html>`);
		win.document.close();
		win.focus();
		setTimeout(() => {
			win.print();
			win.close();
		}, 500);
	}

	document.getElementById('printSelectedIds').addEventListener('click', function () {
		let selected = [];
		document.querySelectorAll('.select-user:checked').forEach(cb => {
			selected.push({
				applicationNo: cb.dataset.applicationno,
				idCard_no: cb.dataset.idCardNo,
				fullName: cb.dataset.fullname,
				gender: cb.dataset.gender,
				civilStatus: cb.dataset.civilstatus,
				birthdate: cb.dataset.birthdate,
				age: cb.dataset.age,
				address: cb.dataset.address,
				barangay: cb.dataset.barangay,
				photo: cb.dataset.photo,
				qr_code: cb.dataset.qr_code
			});
		});

		if (selected.length === 0) {
			alert('Please select at least one user.');
			return;
		}

		printSeniorID(selected);
	});
</script>