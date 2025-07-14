<style>
 
</style>
<div class="card">
    <div class="card-body">

    <form action="save_senior_citizen.php" method="POST" enctype="multipart/form-data">
    <h2>Senior Citizen Registration Form</h2>
<!-- Personal Information -->
<div class="form-section">
  <h5>Personal Information</h5>
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">First Name *</label>
      <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Middle Name</label>
      <input type="text" name="middle_name" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Last Name *</label>
      <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-12">
      <label class="form-label">Address *</label>
      <textarea name="address" class="form-control" rows="2" required></textarea>
    </div>
    <div class="col-md-6">
      <label class="form-label">Telephone</label>
      <input type="text" name="telephone" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Mobile No. *</label>
      <input type="text" name="mobile_no" class="form-control" placeholder="+639XXXXXXXXX" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">E-mail Address</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Birthdate *</label>
      <input type="date" name="birthdate" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Place of Birth *</label>
      <input type="text" name="place_of_birth" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Sex *</label>
      <select name="sex" class="form-select" required>
        <option value="">Choose option</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Civil Status *</label>
      <select name="civil_status" class="form-select" required>
        <option value="">Choose option</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Widowed">Widowed</option>
        <option value="Divorced">Divorced</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Blood Type *</label>
      <select name="blood_type" class="form-select" required>
        <option value="">Choose option</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
        <option value="O">O</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Religion *</label>
      <select name="religion" class="form-select" required>
        <option value="">Choose option</option>
        <option value="Roman Catholic">Roman Catholic</option>
        <option value="Christian">Christian</option>
        <option value="Muslim">Muslim</option>
        <option value="Other">Other</option>
      </select>
    </div>
  </div>
</div>

<!-- Government IDs -->
<div class="form-section">
  <h5>Government IDs</h5>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">GSIS No.</label>
      <input type="text" name="gsis_no" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">SSS No.</label>
      <input type="text" name="sss_no" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">TIN No.</label>
      <input type="text" name="tin_no" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">PhilHealth No.</label>
      <input type="text" name="philhealth_no" class="form-control">
    </div>
  </div>
</div>

<!-- Employment & Classification -->
<div class="form-section">
  <h5>Employment and Classification</h5>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Employment Status *</label>
      <select name="employment_status" class="form-select" required>
        <option value="">Choose option</option>
        <option value="Employed">Employed</option>
        <option value="Self-employed">Self-employed</option>
        <option value="Unemployed">Unemployed</option>
        <option value="Retired">Retired</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Classification *</label>
      <select name="classification" class="form-select" required>
        <option value="">Choose option</option>
        <option value="Indigent">Indigent</option>
        <option value="Non-indigent">Non-indigent</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Monthly Pension *</label>
      <select name="monthly_pension" class="form-select" required>
        <option value="">Choose option</option>
        <option value="With Pension">With Pension</option>
        <option value="Without Pension">Without Pension</option>
      </select>
    </div>
  </div>
</div>

<!-- Emergency Contact -->
<div class="form-section">
  <h5>In Case of Emergency</h5>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Contact Person *</label>
      <input type="text" name="emergency_contact_person" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Contact Number *</label>
      <input type="text" name="emergency_contact_number" class="form-control" required>
    </div>
  </div>
</div>

<!-- Upload Valid ID -->
<div class="form-section">
  <h5>Valid Identification</h5>
  <input type="file" name="valid_id" class="form-control" required>
</div>

<!-- Submit -->
<div class="text-center">
  <button type="submit" class="btn btn-success btn-lg">Submit Registration</button>
</div>

</form>
    </div>
</div>