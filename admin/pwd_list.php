<style>
	.profile-section {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.profile-pic {
		width: 200px;
		height: 200px;
		background-color: #ddd;
		border: 1px solid #000;
		margin-bottom: 5px;
	}

	.id-number-display {
		width: 100%;
		text-align: center;
		margin-top: 5px;
	}

	.id-number-display .number {
		border-bottom: 1px solid #000;
		font-weight: bold;
		font-size: 14px;
		display: inline-block;
		padding-bottom: 2px;
		min-width: 100px;
	}

	.id-number-display .label {
		font-size: 10px;
		margin-top: 2px;
	}

	.underline-name {
		text-align: center;
		display: inline-block;
		border-bottom: 1px solid #000;
		font-weight: bold;
		font-size: 20px;
		padding-bottom: 2px;
		margin-bottom: 0;
		width: 100%;
	}

	.label-under-name {
		text-transform: uppercase;
		text-align: center;
		display: inline-block;
		font-size: 16px;
		margin-top: 0;
		margin-bottom: 8px;
		width: 100%;
	}

	.details p {
		margin: 4px 0;
	}

	.id-number {
		border-bottom: 1px solid black;
		font-size: 14px;
		margin-top: 10px;
		width: 100%;
		text-align: center;
	}

	.id-label {
		font-size: 10px;
		text-align: center;
		margin-top: 2px;
	}

	.name-underlined {
		border-bottom: 1px solid black;
		display: inline-block;
		padding-bottom: 2px;
	}

	.name-label {
		font-size: 10px;
		margin-top: 2px;
	}

	.id-card-print-wrapper {
		page-break-after: always;
	}

	.id-card-print {
		width: 700px;
		height: 460px;
		border: 1px solid #000;
		box-sizing: border-box;
		padding: 0.1in;
		font-family: Arial, sans-serif;
		font-size: 10px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		background-color: white;
	}

	.id-card-container {
		display: flex;
		gap: 10px;
		flex-wrap: wrap;
	}

	.profile-pic {
		width: 200px;
		height: 200px;
		background-color: #ddd;
		border: 1px solid #000;
		margin-bottom: 5px;
	}

	.details p {
		margin: 8px 0;
		/* Increased spacing between lines */
		font-size: 12px;
		line-height: 1.4;
		/* Added line height for better readability */
	}

	.signature-box {
		margin-top: 10px;
		/* Increased margin */
		text-align: center;
		border-top: 1px solid #000;
		font-size: 10px;
		padding-top: 5px;
		/* Increased padding */
		width: 200px;
	}

	.id-card-print .header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 10px;
		/* Added margin */
	}



	.id-card-print .title {
		text-align: center;
		font-size: 16px;
		font-weight: bold;
		line-height: 1.3;
	}

	.barangay {
		text-align: center;
		font-size: 16px;
		font-weight: bold;
		line-height: 1.3;
	}


	.id-card-print .content {
		display: flex;
		margin-top: 10px;
		justify-content: space-between;
		/* Ensures space between left and right */
	}

	.id-card-print .left {
		order: 2;
		/* Moves the profile pic to the right */
		margin-left: 20px;
		/* Added space between details and photo */
	}

	.id-card-print .right {
		order: 1;
		/* Moves details to the left */
		flex: 1;
		padding-right: 20px;
		/* Added padding */
	}

	.id-card-print .footer {
		display: flex;
		justify-content: space-between;
		align-items: flex-end;
		margin-top: 20px;
		/* Increased margin */
		padding: 0 10px;
	}


	@media print {
		body * {
			visibility: hidden;
		}

		#printArea,
		#printArea * {
			visibility: visible;
		}

		#printArea {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>


<div class="row">


	<div class="col-sm">
		<div class="card">
			<div class="card-header">
				<button class="btn btn-info btn-flat"><i class="fa fa-file-excel"></i> Download</button>
				<button class="btn btn-success btn-flat" onclick="generateAndPrintID()">
					<i class="fa fa-print"></i> Print ID Selected
				</button>
			</div>
			<div class="card-body">
				<!-- <h4 class="text1-lightblue font-weight-bold">Subject List</h4> -->
				<!-- <div class="lignblue"></div> -->
				<br>
				<table class="table table-hover" id="list">

					<thead>
						<tr class="text-center">
							<th><input type="checkbox" name="" id=""></th>
							<th class="text-center">Application No.</th>
							<th>Status</th>
							<th class="text-center">Barangay</th>
							<th class="text-center">FullName</th>
							<th class="text-center">Type of Disability</th>

							<th class="text-center">Gender</th>
							<th class="text-center">Civil Status</th>


							<th class="text-center">Birthdate</th>
							<th class="text-center">Age</th>

							<th class="text-center">Full Address</th>

							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<tr class="text-center">

							<td><input type="checkbox" name="" id=""></td>
							<td>53252</td>
							<td>
								<span class="badge badge-success">Accepted</span>
								<button class="btn btn-sm btn-flat btn-primary">Print</button>

							</td>
							<td>Anao</td>
							<td>Juan Dela Cruz</td>
							<td>Physical Disability</td> <!-- Replace with dynamic value -->

							<td>Male</td>
							<td>Widowed</td>
							<td>January 1, 1963</td>
							<td>86</td>
							<td>Purok 1, Anao, Cabagan, Isabela</td>

							<td>
								<a href="./index.php?page=view_application_form&id=<?php ?>"
									class="btn btn-success text-white btn-sm btn-flat">
									<i class="fas fa-eye"></i>
								</a>
								<a href="./index.php?page=edit_pwd_info&sec_id=<?php ?>"
									class="btn btn-info text-white btn-sm btn-flat">
									<i class="fas fa-edit"></i>
								</a>
								<a href="javascript:void(0)" data-id="<?php ?>"
									class="delete_pwd btn btn-danger btn-sm  btn-flat ">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>

						<tr class="text-center">

							<td><input type="checkbox" name="" id=""></td>
							<td>53252</td>
							<td>
								<span class="badge badge-warning">For Review</span>
							</td>
							<td>Catabayungan</td>
							<td>Pepe Dela Paz</td>
							<td>Physical Disability</td> <!-- Replace with dynamic value -->

							<td>Male</td>
							<td>Married</td>
							<td>February 5, 1967</td>
							<td>86</td>
							<td>Purok 1, Catabayungan, Cabagan, Isabela</td>

							<td>
								<a href="./index.php?page=view_application_form&id=<?php ?>"
									class="btn btn-success text-white btn-sm btn-flat">
									<i class="fas fa-eye"></i>
								</a>
								<a href="./index.php?page=edit_section&sec_id=<?php ?>"
									class="btn btn-info text-white btn-sm btn-flat">
									<i class="fas fa-edit"></i>
								</a>
								<a href="javascript:void(0)" data-id="<?php ?>"
									class="delete_subject btn btn-danger btn-sm  btn-flat ">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#list').dataTable()

	})


</script>

<!-- Hidden printable card area -->
<div id="printArea" style="display:none;"></div>
<script>
	function generateAndPrintID() {
		const selectedRow = document.querySelector('#list tbody tr input[type="checkbox"]:checked');
		if (!selectedRow) {
			alert('Please select a row to print the ID card.');
			return;
		}

		const row = selectedRow.closest('tr');
		const tds = row.querySelectorAll('td');

		// Get absolute paths to your images
		const phFlagPath = window.location.origin + '/citicare/assets/img/ph_flag.png';
		const sealPath = window.location.origin + '/citicare/assets/img/santa maria-seal.png';
		const pwdLogoPath = '/citicare/assets/img/pwd_logo.png';

		const data = {
			applicationNo: tds[1].innerText,
			status: tds[2].innerText.trim(),
			barangay: tds[3].innerText,
			fullName: tds[4].innerText,
			disability: tds[5].innerText,
			gender: tds[6].innerText,
			civilStatus: tds[7].innerText,
			birthdate: tds[8].innerText,
			age: tds[9].innerText,
			address: tds[10].innerText
		};

		const cardHtml = `
		<div style="display: flex; flex-direction: row; gap: 30px;">
			<div class="id-card-print-wrapper">
				<!-- FRONT -->
				<div class="id-card-print">
					<div class="header">
						<img src="${phFlagPath}" alt="Philippine Flag" height="70" />
						<div class="title">
							Republic of the Philippines<br>
							Province of Isabela<br>
							<span class="text-uppercase"> Municipality of Santa Maria </span><br>
							
						</div>
						 <div>
						 <img src="${pwdLogoPath}" class="pwd-logo" width="80" alt="PWD Logo" />
						<img src="${sealPath}" class="barangay-logo" width="80" height="80" alt="Municipal Seal" />
						 </div>
					</div>
					<span class="barangay text-uppercase">Barangay: <u> ${data.barangay} </u></span>
					<br>
					<div class="content">
					<div class="right details mt-3">
					<p>
						<span class="underline-name">${data.fullName}</span><br>
						<span class="label-under-name">Name</span>
					</p>
					<p>
					 <span class="underline-name">${data.disability}</span><br>
						<span class="label-under-name">Type of Disability</span>

					</p>

					<p>
					 <span class="underline-name" style="color:white">SIGNATURE</span><br>
						<span class="label-under-name">Signature</span>

					</p>

					
				</div>
				<div class="left profile-section">
					<div class="profile-pic"></div>
					<div class="id-number-display">
						<div class="underline-name">${data.applicationNo}</div>
						<div class="label-under-name">ID No.</div>
					</div>
				</div>

				
			</div>

<p class="text-center h4 text-uppercase">Valid Anywhere in the Country</p>
					
				</div>
				<br>
				<!-- BACK -->
				<div class="id-card-print">
					<div class="details">
						<p><strong>ADDRESS:</strong> ${data.address}</p>
						<p><strong>DATE OF BIRTH:</strong> ${data.birthdate}</p>
						<p><strong>SEX:</strong> ${data.gender}</p>
						<p><strong>BLOOD TYPE:</strong> ___________</p>
						<p><strong>DATE ISSUED:</strong> ${new Date().toLocaleDateString()}</p>
						<p><strong>IN CASE OF EMERGENCY PLEASE NOTIFY:</strong></p>
						<p><strong>NAME:</strong> _____________</p>
						<p><strong>CONTACT NO.:</strong> _____________</p>
						<br>
						<div class="signature-box">HILARIO G. PAGARAN<br><small>Municipal Mayor</small></div>
						<br>
						<small style="font-size: 10px; display: block;">
							THE HOLDER OF THIS CARD IS A PERSON WITH DISABILITY REGISTERED UNDER REPUBLIC ACT NO. 9442. 
							THIS CARD IS NON-TRANSFERABLE AND VALID FOR 3 YEARS.
						</small>
					</div>
				</div>
			</div>
		</div>`;

		const printArea = document.getElementById('printArea');
		printArea.innerHTML = cardHtml;
		printArea.style.display = 'block';

		// Ensure images are loaded before printing
		const images = printArea.getElementsByTagName('img');
		let loadedImages = 0;

		for (let img of images) {
			img.onload = function () {
				loadedImages++;
				if (loadedImages === images.length) {
					window.print();
					printArea.innerHTML = '';
					printArea.style.display = 'none';
				}
			};
			// If image fails to load, still proceed with print
			img.onerror = function () {
				loadedImages++;
				if (loadedImages === images.length) {
					window.print();
					printArea.innerHTML = '';
					printArea.style.display = 'none';
				}
			};
		}

		// Fallback in case images don't fire events
		setTimeout(function () {
			window.print();
			printArea.innerHTML = '';
			printArea.style.display = 'none';
		}, 700);
	}
</script>