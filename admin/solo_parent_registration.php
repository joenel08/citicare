
<div class="card">
    <div class="card-body">

        <form action="#" method="POST" enctype="multipart/form-data">
            <h2>Solo Parent Registration Form</h2>
             <!-- Photo Upload -->
    <div class="form-section text-center">
      <div class="photo-placeholder mb-2">
        2x2 Photo Here
      </div>
      <div class="mb-3">
        <input type="file" name="photo" class="form-control" required>
      </div>
    </div>

    <!-- Personal Information -->
    <div class="form-section">
      <h5>Personal Information</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-2">
          <label class="form-label">Age *</label>
          <input type="number" name="age" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Sex *</label>
          <select name="sex" class="form-select" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Date of Birth *</label>
          <input type="date" name="dob" class="form-control" required>
        </div>
        <div class="col-md-8">
          <label class="form-label">Place of Birth *</label>
          <input type="text" name="place_of_birth" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Address *</label>
          <textarea name="address" rows="2" class="form-control" required></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Occupation *</label>
          <input type="text" name="occupation" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Monthly Income *</label>
          <input type="number" name="monthly_income" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Total Monthly Family Income *</label>
          <input type="number" name="total_family_income" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Contact Number *</label>
          <input type="text" name="contact_number" class="form-control" required>
        </div>
      </div>
    </div>

    <!-- Family Composition -->
    <div class="form-section">
      <h5>Family Composition</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Relationship</th>
              <th>Age</th>
              <th>Status</th>
              <th>Educational Attainment</th>
              <th>Occupation/Income</th>
            </tr>
          </thead>
          <tbody id="familyTable">
            <tr>
              <td><input type="text" name="family_name[]" class="form-control"></td>
              <td><input type="text" name="family_relationship[]" class="form-control"></td>
              <td><input type="number" name="family_age[]" class="form-control"></td>
              <td><input type="text" name="family_status[]" class="form-control"></td>
              <td><input type="text" name="family_education[]" class="form-control"></td>
              <td><input type="text" name="family_occupation_income[]" class="form-control"></td>
            </tr>
          </tbody>
        </table>
        <button type="button" class="btn btn-sm btn-primary" onclick="addFamilyRow()">Add Row</button>
      </div>
    </div>

    <!-- Circumstances -->
    <div class="form-section">
      <h5>Classification/Circumstances of Being a Solo Parent *</h5>
      <textarea name="circumstances" class="form-control" rows="4" required></textarea>
    </div>

    <!-- Needs/Problems -->
    <div class="form-section">
      <h5>Needs/Problems of Solo Parent *</h5>
      <textarea name="needs" class="form-control" rows="4" required></textarea>
    </div>

    <!-- Family Resources -->
    <div class="form-section">
      <h5>Family Resources *</h5>
      <textarea name="resources" class="form-control" rows="4" required></textarea>
    </div>

    <!-- Declaration -->
    <div class="form-section">
      <h5>Declaration</h5>
      <p>I hereby certify that the information given above is true and correct. I understand that any misinterpretation will subject me to criminal and civil liabilities under existing laws.</p>
      <div class="row">
        <div class="col-md-6">
          <label class="form-label">Date *</label>
          <input type="date" name="declaration_date" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Signature/Thumbmark *</label>
          <input type="text" name="signature" class="form-control" placeholder="Type Full Name for Signature" required>
        </div>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="text-center">
      <button type="submit" class="btn btn-success btn-lg">Submit Registration</button>
    </div>
        </form>
    </div>
</div>

<script>
function addFamilyRow() {
  var table = document.getElementById("familyTable");
  var row = table.insertRow();
  for (var i = 0; i < 6; i++) {
    var cell = row.insertCell(i);
    cell.innerHTML = '<input type="text" name="' + ['family_name[]', 'family_relationship[]', 'family_age[]', 'family_status[]', 'family_education[]', 'family_occupation_income[]'][i] + '" class="form-control">';
  }
}
</script>