<style>
   

.form-container {
  background: #fff;
  max-width: 1200px;
  margin: auto;
  padding: 30px;
  border: 1px solid #ccc;
}

header {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 30px;
}

.logo {
  width: 80px;
  height: 80px;
}

.form-header {
  flex: 1;
  text-align: center;
}

.photo-box {
  width: 100px;
  height: 100px;
  border: 1px solid #000;
  font-size: 12px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 1.2;
}

form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
}

input[type="text"],
input[type="email"],
input[type="date"] {
  padding: 5px;
  width: 200px;
}

fieldset {
  border: 1px solid #ccc;
  padding: 15px;
}

legend {
  font-weight: bold;
}

</style>
 <div class="card">
    <div class="card-header">
        <button class="btn-primary btn-flat btn">Accept</button>
        <button class="btn-danger btn-flat btn">Decline</button>

    </div>
    <div class="card-body">
    <div class="form-container">
    <header>
      <img src="assets/img/doh.png" alt="DOH Logo" class="logo" />
      <div class="form-header">
        <h2>DEPARTMENT OF HEALTH</h2>
        <h3>Philippine Registry For Persons with Disabilities Version 4.0</h3>
        <h1>Application Form</h1>
      </div>
      
      <div class="photo-box">Place 1x1”<br>Photo Here</div>
    </header>

    <form>
      <!-- Section 1 -->
      <div class="form-group">
        <label>1. </label>
        <label><input type="radio" name="application_type" /> New Applicant</label>
        <label><input type="radio" name="application_type" /> Renewal</label>
      </div>

      <!-- Section 2 & 3 -->
      <div class="form-group">
        <label>2. PWD Number:</label>
        <input type="text" />
        <label>3. Date Applied:</label>
        <input type="date" />
      </div>

      <!-- Section 4 -->
      <fieldset>
        <legend>4. PERSONAL INFORMATION</legend>
        <input type="text" placeholder="Last Name" />
        <input type="text" placeholder="First Name" />
        <input type="text" placeholder="Middle Name" />
        <input type="text" placeholder="Suffix" />
      </fieldset>

      <!-- Section 5 & 6 -->
      <div class="form-group">
        <label>5. Date of Birth:</label>
        <input type="date" />
        <label>6. Sex:</label>
        <label><input type="radio" name="sex" /> Female</label>
        <label><input type="radio" name="sex" /> Male</label>
      </div>

      <!-- Section 7 -->
      <div class="form-group">
        <label>7. Civil Status:</label>
        <label><input type="radio" name="civil_status" /> Single</label>
        <label><input type="radio" name="civil_status" /> Separated</label>
        <label><input type="radio" name="civil_status" /> Cohabitation (live-in)</label>
        <label><input type="radio" name="civil_status" /> Married</label>
        <label><input type="radio" name="civil_status" /> Widow/er</label>
      </div>

      <!-- Section 8 & 9 -->
      <fieldset>
        <legend>8. TYPE OF DISABILITY</legend>
        <label><input type="checkbox" /> Deaf or Hard of Hearing</label>
        <label><input type="checkbox" /> Intellectual Disability</label>
        <label><input type="checkbox" /> Learning Disability</label>
        <label><input type="checkbox" /> Mental Disability</label>
        <label><input type="checkbox" /> Physical Disability (Orthopedic)</label>
        <label><input type="checkbox" /> Psychosocial Disability</label>
        <label><input type="checkbox" /> Speech and Language Impairment</label>
        <label><input type="checkbox" /> Visual Disability</label>
        <label><input type="checkbox" /> Cancer (RA11215)</label>
        <label><input type="checkbox" /> Rare Disease (RA10747)</label>
      </fieldset>

      <fieldset>
        <legend>9. CAUSE OF DISABILITY</legend>
        <label><input type="checkbox" /> Congenital / Inborn</label>
        <label><input type="checkbox" /> Acquired</label>
        <label><input type="checkbox" /> Autism</label>
        <label><input type="checkbox" /> ADHD</label>
        <label><input type="checkbox" /> Cerebral Palsy</label>
        <label><input type="checkbox" /> Chronic Illness</label>
        <label><input type="checkbox" /> Injury</label>
        <label><input type="checkbox" /> Down Syndrome</label>
      </fieldset>

      <!-- Section 10 -->
      <fieldset>
        <legend>10. RESIDENCE ADDRESS</legend>
        <input type="text" placeholder="House No. and Street" />
        <input type="text" placeholder="Barangay" />
        <input type="text" placeholder="Municipality" />
        <input type="text" placeholder="Province" />
        <input type="text" placeholder="Region" />
      </fieldset>

      <!-- Section 11 -->
      <fieldset>
        <legend>11. CONTACT DETAILS</legend>
        <input type="text" placeholder="Telephone No." />
        <input type="text" placeholder="Mobile No." />
        <input type="email" placeholder="Email Address" />
      </fieldset>

      <!-- Section 12 -->
      <fieldset>
        <legend>12. EDUCATIONAL ATTAINMENT</legend>
        <label><input type="checkbox" /> Kindergarten</label>
        <label><input type="checkbox" /> Elementary</label>
        <label><input type="checkbox" /> Junior High School</label>
        <label><input type="checkbox" /> Senior High School</label>
        <label><input type="checkbox" /> College</label>
        <label><input type="checkbox" /> Vocational</label>
        <label><input type="checkbox" /> Post Graduate</label>
      </fieldset>

      <!-- Section 13 -->
      <fieldset>
        <legend>13. STATUS OF EMPLOYMENT</legend>
        <label><input type="radio" name="emp_status" /> Employed</label>
        <label><input type="radio" name="emp_status" /> Unemployed</label>
        <label><input type="radio" name="emp_status" /> Self-employed</label>

        <br/><br/>
        <label>13b. TYPES OF EMPLOYMENT:</label>
        <label><input type="radio" name="emp_type" /> Permanent / Regular</label>
        <label><input type="radio" name="emp_type" /> Seasonal</label>
        <label><input type="radio" name="emp_type" /> Casual</label>
        <label><input type="radio" name="emp_type" /> Emergency</label>

        <br/><br/>
        <label>13a. CATEGORY OF EMPLOYMENT:</label>
        <label><input type="radio" name="emp_category" /> Government</label>
        <label><input type="radio" name="emp_category" /> Private</label>
      </fieldset>

      <!-- Section 14 -->
      <fieldset>
        <legend>14. OCCUPATION</legend>
        <label><input type="checkbox" /> Managers</label>
        <label><input type="checkbox" /> Professionals</label>
        <label><input type="checkbox" /> Technicians and Associate Professionals</label>
        <label><input type="checkbox" /> Clerical Support Workers</label>
        <label><input type="checkbox" /> Service and Sales Workers</label>
        <label><input type="checkbox" /> Skilled Agricultural, Forestry and Fishery Workers</label>
        <label><input type="checkbox" /> Craft and Related Trade Workers</label>
        <label><input type="checkbox" /> Plant and Machine Operators and Assemblers</label>
        <label><input type="checkbox" /> Elementary Occupations</label>
        <label><input type="checkbox" /> Armed Forces Occupations</label>
        <label><input type="checkbox" /> Others (specify): ____________</label>
      </fieldset>

      <!-- Section 15 -->
      <fieldset>
        <legend>15. ORGANIZATION INFORMATION</legend>
        <input type="text" placeholder="Organization Affiliated" />
        <input type="text" placeholder="Contact Person" />
        <input type="text" placeholder="Office Address" />
        <input type="text" placeholder="Tel. Nos." />
      </fieldset>

      <!-- Section 16 -->
      <fieldset>
        <legend>16. ID REFERENCE NO.</legend>
        <input type="text" placeholder="SSS NO." />
        <input type="text" placeholder="GSIS NO." />
        <input type="text" placeholder="PAG-IBIG NO." />
        <input type="text" placeholder="PSN NO." />
        <input type="text" placeholder="PhilHealth NO." />
      </fieldset>

      <!-- Section 17 -->
      <fieldset>
        <legend>17. FAMILY BACKGROUND</legend>
        <input type="text" placeholder="Father's Name - Last" />
        <input type="text" placeholder="Father's Name - First" />
        <input type="text" placeholder="Father's Name - Middle" />
        <input type="text" placeholder="Mother's Name" />
        <input type="text" placeholder="Guardian" />
      </fieldset>

      <!-- Section 18 -->
      <fieldset>
        <legend>18. ACCOMPLISHED BY</legend>
        <label><input type="radio" name="accomplished_by" /> Applicant</label>
        <label><input type="radio" name="accomplished_by" /> Guardian</label>
        <label><input type="radio" name="accomplished_by" /> Representative</label>
        <input type="text" placeholder="Last Name" />
        <input type="text" placeholder="First Name" />
        <input type="text" placeholder="Middle Name" />
      </fieldset>

      <!-- Section 19 to 24 -->
      <fieldset>
        <legend>19. NAME OF CERTIFYING PHYSICIAN</legend>
        <input type="text" placeholder="Name" />
        <input type="text" placeholder="License No." />
      </fieldset>

      <fieldset>
        <legend>20. PROCESSING OFFICER</legend>
        <input type="text" placeholder="Name" />
      </fieldset>

      <fieldset>
        <legend>21. APPROVING OFFICER</legend>
        <input type="text" placeholder="Name" />
      </fieldset>

      <fieldset>
        <legend>22. ENCODER</legend>
        <input type="text" placeholder="Name" />
      </fieldset>

      <fieldset>
        <legend>23. NAME OF REPORTING UNIT (OFFICE/SECTION)</legend>
        <input type="text" placeholder="Office/Section" />
      </fieldset>

      <fieldset>
        <legend>24. CONTROL NO.</legend>
        <input type="text" placeholder="Control No." />
      </fieldset>

      <div style="text-align:right; margin-top:10px;">
        <em>Revised as of August 1, 2021</em>
      </div>
    </form>
  </div>
    </div>
 </div>

