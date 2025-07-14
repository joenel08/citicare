<div class="card mt-4">
    <div class="card-header">
        <button class="btn btn-success btn-flat" id="printSoloParentIDs"><i class="fa fa-print"></i> Print Solo Parent ID</button>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="soloParentTable">
            <thead>
                <tr class="text-center">
                    <th><input type="checkbox" id="selectAllSolo"></th>
                    <th>Application No.</th>
                    <th>Barangay</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>
                        <input type="checkbox" class="select-solo" 
                            data-applicationno="84210"
                            data-fullname="Maria Santos"
                            data-gender="Female"
                            data-civilstatus="Single"
                            data-birthdate="March 3, 1990"
                            data-age="34"
                            data-address="Zone 3, San Vicente, Cabagan, Isabela"
                            data-barangay="San Vicente"
                        >
                    </td>
                    <td>84210</td>
                    <td>San Vicente</td>
                    <td>Maria Santos</td>
                    <td>Female</td>
                    <td>Single</td>
                    <td>March 3, 1990</td>
                    <td>34</td>
                    <td>Zone 3, San Vicente, Cabagan, Isabela</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <!-- Add more rows here -->
            </tbody>
        </table>
    </div>
</div>
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
