<?php include('db_connect.php'); ?>
<!-- 
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h1>Welcome User!</h1>
        <p class="m-0 p-0">This system is designed to modernize and improve the efficiency of the registration process
          for vulnerable populations, including persons with disabilities (PWDs), senior citizens, and solo parents.
        </p>
        <br>
        <a href="./index.php?page=subject_list" class="btn btn-flat btn-success">Continue</a>
      </div>
    </div>
  </div>
</div>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Congratulations!</h4>
  <p>Your registration has been successfully accepted!</p>
  <hr>
  <button class="btn btn-light btn-flat">View Details</button>
</div> -->

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h1>Welcome Admin!</h1>
        <p class="m-0 p-0">This system is designed to modernize and improve the efficiency of the registration process
          for vulnerable populations, including persons with disabilities (PWDs), senior citizens, and solo parents.
        </p>
        <br>
        <a href="./index.php?page=subject_list" class="btn btn-flat btn-success">Continue</a>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-12 col-sm-4">
    <div class="info-box">
      <span class="info-box-icon bg-warning elevation-1"><img src="assets/img/senior_icon.png" class="p-2"
          alt=""></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Senior Citizen</span>
        <span class="info-box-number">
          1560

        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><img src="assets/img/pwd_icon.png" class="p-2" alt=""></span>

      <div class="info-box-content">
        <span class="info-box-text">Total PWDs</span>
        <span class="info-box-number">678</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-primary elevation-1"><img src="assets/img/solo_parent_icon.png" class="p-2"
          alt=""></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Solo Parents</span>
        <span class="info-box-number">760</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>

<div class="card">
  <div class="card-body">
    <canvas id="barangayChart" width="1200" height="600"></canvas>
  </div>
</div>

<?php
// Dummy data


$barangays = [
  "Bangad", "Buenavista", "Calamagui North", "Calamagui East", "Calamagui West", 
  "Divisoria", "Lingaling", "Mozzozzin Sur", "Mozzozzin North", "Naganacan", 
  "Poblacion 1", "Poblacion 2", "Poblacion 3", "Quinagabian", "San Antonio", 
  "San Isidro East", "San Isidro West", "San Rafael West", "San Rafael East", 
  "Villabuena"
];

// For now, let's repeat the data to match the number of barangays
// Adjusting arrays for a match to the number of barangays
$senior_citizens = array_merge([59, 35, 63, 89, 139, 77, 51, 50, 130, 85], [63, 89, 139, 77, 51, 50, 59, 35, 63, 89]);
$pwds = array_merge([14, 9, 15, 22, 34, 19, 12, 12, 31, 21], [15, 22, 34, 19, 12, 12, 14, 9, 15, 22]);
$solo_parents = array_merge([25, 15, 27, 38, 60, 33, 22, 22, 56, 37], [27, 38, 60, 33, 22, 22, 25, 15, 27, 38]);

// Create an associative array to hold the barangay and their respective data
$barangay_data = [];

// Loop through the barangays and match with the corresponding data
for ($i = 0; $i < count($barangays); $i++) {
  $barangay_data[$barangays[$i]] = [
      "senior_citizens" => isset($senior_citizens[$i]) ? $senior_citizens[$i] : 0,
      "pwds" => isset($pwds[$i]) ? $pwds[$i] : 0,
      "solo_parents" => isset($solo_parents[$i]) ? $solo_parents[$i] : 0
  ];
}

?>


<script>
// Convert PHP arrays to JavaScript
const barangays = <?php echo json_encode($barangays); ?>;
const seniorCitizens = <?php echo json_encode($senior_citizens); ?>;
const pwds = <?php echo json_encode($pwds); ?>;
const soloParents = <?php echo json_encode($solo_parents); ?>;

const ctx = document.getElementById('barangayChart').getContext('2d');
const barangayChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: barangays,
        datasets: [
            {
                label: 'Senior Citizens',
                data: seniorCitizens,
                backgroundColor: 'rgba(75, 192, 192, 0.7)'
            },
            {
                label: 'PWDs',
                data: pwds,
                backgroundColor: 'rgba(153, 102, 255, 0.7)'
            },
            {
                label: 'Solo Parents',
                data: soloParents,
                backgroundColor: 'rgba(255, 159, 64, 0.7)'
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                stacked: true
            },
            y: {
                beginAtZero: true,
                stacked: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Population Data per Barangay (Dummy Data)'
            },
            legend: {
                position: 'top'
            }
        }
    }
});
</script>