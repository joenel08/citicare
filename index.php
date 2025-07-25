<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php
if (!isset($_SESSION['login_id']))
  header('location:signin.php');
include 'db_connect.php';
ob_start();
if (!isset($_SESSION['system'])) {

  $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
  foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
  }
}
ob_end_flush();

include 'header.php'
  ?>

<style>
  .content-header {
    background-color: #28a745 !important;
    color: #ffffff;
  }

  .content {
    margin-top: -4% !important;
  }
</style>
<?php

function ordinal_suffix1($num)
{
  $num = $num % 100; // protect against large numbers
  if ($num < 11 || $num > 13) {
    switch ($num % 10) {
      case 1:
        return $num . 'st';
      case 2:
        return $num . 'nd';
      case 3:
        return $num . 'rd';
    }
  }
  return $num . 'th';
}
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include 'topbar.php' ?>
    <?php include $_SESSION['login_view_folder'] . 'sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
      <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-5 mt-2">
            <div class="col">
              <h3 class="m-0"><?php echo $title ?></h3>
              <p><span class="text-white">Home</span>
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';

                if ($page != 'home') { ?>
                  <i class="fas fa-angle-right mr-2 ml-2 text-white"></i> <span class="text-white border-bottom">
                    <?php echo $title; ?></span>
                <?php } ?>
              </p>
            </div><!-- /.col -->
           

          </div><!-- /.row -->
          <!-- <hr class="border-success"> -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          $page = isset($_GET['page']) ? $_GET['page'] : 'home';
          if (!file_exists($_SESSION['login_view_folder'] . $page . ".php")) {
            include '404.html';
          } else {
            include $_SESSION['login_view_folder'] . $page . '.php';

          }
          ?>
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header  bg-success text-white">
              <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
              <div id="delete_content"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success text-white btn-flat" id='confirm' onclick="">Continue</button>
              <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success text-uppercase">
              <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-success text-white" id='submit'
                onclick="$('#uni_modal form').submit()">Save</button>
              <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-arrow-right"></span>
              </button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <img src="" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <!-- <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a href="https://schedbot.online//">FBETMS</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b><?php echo $_SESSION['system']['name'] ?></b>
      </div>
    </footer> -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <!-- Bootstrap -->
  <?php include 'footer.php' ?>
</body>

</html>