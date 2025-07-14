<style>
    h2 {
        text-align: center;
    }

    .section-title {
        background: #ddd;
        padding: 10px;
        margin-top: 20px;
        font-weight: bold;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 7px;
        margin-top: 5px;
    }

    .half {
        width: 48%;
        float: left;
        margin-right: 4%;
    }

    .half:last-child {
        margin-right: 0;
    }

    .checkbox-group,
    .radio-group {
        margin-top: 10px;
    }

    .checkbox-group label,
    .radio-group label {
        display: inline-block;
        margin-right: 20px;
    }

    .clearfix {
        clear: both;
    }

    .photo-upload {
        text-align: center;
        margin: 20px 0;
    }
</style>
<div class="card">
    <div class="card-body">

        <form action="#" method="POST" enctype="multipart/form-data">
            <h2>PWD Registration Form</h2>

            <div class="section-title">1. Application Type</div>
            <div class="radio-group">
                <label><input type="radio" name="application_type" value="new" required> New Applicant</label>
                <label><input type="radio" name="application_type" value="renewal"> Renewal</label>
            </div>
            <div class="photo-upload">
                <label>Place 1”x1” Photo Here:</label><br>
                <input type="file" name="photo">
            </div>

            <div class="section-title">2. PWD Number and Application Date</div>
            <label>Persons with Disability Number (RR-PPMM-BBB-NNNNNNN)*</label>
            <input type="text" name="pwd_number" required>

            <label>Date Applied *</label>
            <input type="date" name="date_applied" required>

            <div class="section-title">4. Personal Information</div>
            <label>Last Name *</label>
            <input type="text" name="last_name" required>

            <label>First Name *</label>
            <input type="text" name="first_name" required>

            <label>Middle Name *</label>
            <input type="text" name="middle_name" required>

            <label>Suffix</label>
            <input type="text" name="suffix">

            <label>Date of Birth *</label>
            <input type="date" name="birthdate" required>

            <div class="radio-group">
                <label>Sex *</label><br>
                <label><input type="radio" name="sex" value="female" required> Female</label>
                <label><input type="radio" name="sex" value="male"> Male</label>
            </div>

            <div class="section-title">7. Civil Status</div>
            <div class="radio-group">
                <label><input type="radio" name="civil_status" value="single" required> Single</label>
                <label><input type="radio" name="civil_status" value="separated"> Separated</label>
                <label><input type="radio" name="civil_status" value="cohabitation"> Cohabitation (live-in)</label>
                <label><input type="radio" name="civil_status" value="married"> Married</label>
                <label><input type="radio" name="civil_status" value="widow"> Widow/er</label>
            </div>

            <div class="section-title">8. Type of Disability *</div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="disability_type[]" value="deaf"> Deaf or Hard of Hearing</label>
                <label><input type="checkbox" name="disability_type[]" value="psychosocial"> Psychosocial
                    Disability</label>
                <label><input type="checkbox" name="disability_type[]" value="intellectual"> Intellectual
                    Disability</label>
                <label><input type="checkbox" name="disability_type[]" value="speech"> Speech and Language
                    Impairment</label>
                <label><input type="checkbox" name="disability_type[]" value="learning"> Learning Disability</label>
                <label><input type="checkbox" name="disability_type[]" value="visual"> Visual Disability</label>
                <label><input type="checkbox" name="disability_type[]" value="mental"> Mental Disability</label>
                <label><input type="checkbox" name="disability_type[]" value="cancer"> Cancer (RA11215)</label>
                <label><input type="checkbox" name="disability_type[]" value="physical"> Physical Disability
                    (Orthopedic)</label>
                <label><input type="checkbox" name="disability_type[]" value="rare_disease"> Rare Disease
                    (RA10747)</label>
            </div>

            <div class="section-title">9. Cause of Disability *</div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="disability_cause[]" value="congenital"> Congenital / Inborn</label>
                <label><input type="checkbox" name="disability_cause[]" value="acquired"> Acquired</label>
                <label><input type="checkbox" name="disability_cause[]" value="autism"> Autism</label>
                <label><input type="checkbox" name="disability_cause[]" value="adhd"> ADHD</label>
                <label><input type="checkbox" name="disability_cause[]" value="cerebral_palsy"> Cerebral Palsy</label>
                <label><input type="checkbox" name="disability_cause[]" value="down_syndrome"> Down Syndrome</label>
                <label><input type="checkbox" name="disability_cause[]" value="chronic_illness"> Chronic Illness</label>
                <label><input type="checkbox" name="disability_cause[]" value="injury"> Injury</label>
            </div>

            <div class="section-title">10. Residence Address *</div>
            <label>House No. and Street *</label>
            <input type="text" name="house_no" required>

            <label>Barangay *</label>
            <input type="text" name="barangay" required>

            <label>Municipality *</label>
            <input type="text" name="municipality" required>

            <label>Province *</label>
            <input type="text" name="province" required>

            <label>Region *</label>
            <input type="text" name="region" required>

            <div class="section-title">11. Contact Details</div>
            <label>Landline No.</label>
            <input type="text" name="landline">

            <label>Mobile No.</label>
            <input type="text" name="mobile">

            <label>Email Address</label>
            <input type="email" name="email">

            <div class="section-title">12. Educational Attainment *</div>
            <select name="education" required>
                <option value="">-- Select --</option>
                <option value="none">None</option>
                <option value="kindergarten">Kindergarten</option>
                <option value="elementary">Elementary</option>
                <option value="junior_high">Junior High School</option>
                <option value="senior_high">Senior High School</option>
                <option value="college">College</option>
                <option value="vocational">Vocational</option>
                <option value="post_graduate">Post Graduate</option>
            </select>

            <div class="section-title">13. Employment Status *</div>
            <select name="employment_status" required>
                <option value="">-- Select --</option>
                <option value="employed">Employed</option>
                <option value="unemployed">Unemployed</option>
                <option value="self_employed">Self-employed</option>
            </select>

            <label>Type of Employment</label>
            <select name="employment_type">
                <option value="">-- Select --</option>
                <option value="permanent">Permanent / Regular</option>
                <option value="seasonal">Seasonal</option>
                <option value="casual">Casual</option>
                <option value="emergency">Emergency</option>
            </select>

            <label>Category of Employment</label>
            <select name="employment_category">
                <option value="">-- Select --</option>
                <option value="government">Government</option>
                <option value="private">Private</option>
            </select>

            <div class="section-title">14. Occupation *</div>
            <input type="text" name="occupation">

            <div class="section-title">15. Organization Information</div>
            <label>Organization Affiliated</label>
            <input type="text" name="organization_affiliated">

            <label>Contact Person</label>
            <input type="text" name="organization_contact">

            <label>Office Address</label>
            <input type="text" name="organization_address">

            <label>Tel Nos.</label>
            <input type="text" name="organization_tel">

            <div class="section-title">16. ID Reference Numbers</div>
            <label>SSS No.</label>
            <input type="text" name="sss_no">

            <label>GSIS No.</label>
            <input type="text" name="gsis_no">

            <label>PAG-IBIG No.</label>
            <input type="text" name="pagibig_no">

            <label>PSN No.</label>
            <input type="text" name="psn_no">

            <label>PhilHealth No.</label>
            <input type="text" name="philhealth_no">

            <div class="section-title">17. Family Background</div>
            <label>Father's Name</label>
            <input type="text" name="father_name">

            <label>Mother's Name</label>
            <input type="text" name="mother_name">

            <label>Guardian's Name</label>
            <input type="text" name="guardian_name">

            <div class="section-title">18. Accomplished By *</div>
            <div class="radio-group">
                <label><input type="radio" name="accomplished_by" value="applicant" required> Applicant</label>
                <label><input type="radio" name="accomplished_by" value="guardian"> Guardian</label>
                <label><input type="radio" name="accomplished_by" value="representative"> Representative</label>
            </div>

            <div class="section-title">19. Certifying Physician</div>
            <label>Name of Certifying Physician</label>
            <input type="text" name="physician_name">

            <label>License No.</label>
            <input type="text" name="license_no">

            <div class="section-title">20-24. Officer Details</div>
            <label>Processing Officer *</label>
            <input type="text" name="processing_officer" required>

            <label>Approving Officer *</label>
            <input type="text" name="approving_officer" required>

            <label>Encoder *</label>
            <input type="text" name="encoder" required>

            <label>Name of Reporting Unit *</label>
            <input type="text" name="reporting_unit" required>

            <label>Control No. *</label>
            <input type="text" name="control_no" required>

            <button class="btn btn-success btn-flat" type="submit">Submit Application</button>
        </form>
    </div>
</div>