<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");

if (!($rights_id == "2")) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <title>SDN - Benutzer Hinzufügen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <?php
        include 'include/design.php';
        ?>

    </head>

    <body>
      <?php
include 'include/sidebar.php';
?>

        <div class="page-wrapper">

            <?php
      include 'include/top-bar.php';
      ?>

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Gerät Hinzufügen</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">System</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Benutzer</a></li>
                                            <li class="breadcrumb-item active">Benutzer Hinzufügen</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->

                  <div class="row">
                      <div class="col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                  <h4 class="card-title">Benutzer Hinzufügen</h4>
                                  <p class="text-muted mb-0">Hier kannst du ein Benutzer Hinzufügen, bitte fülle alle Felder dafür aus.</p>
                              </div><!--end card-header-->
                              <div class="card-body">
                                  <form class="needs-validation" novalidate method="post" action="user-add-action.php">
                                    <input type=hidden name=todo value=add-user>
                                      <div class="form-row">
                                          <div class="col-md-4 mb-3">
                                              <label for="validationCustom01">Benutzername</label>
                                              <input type="text" class="form-control" name="form_username" id="form_username" placeholder="Benutzername" required>
                                          </div><!--end col-->
                                          <div class="col-md-4 mb-3">
                                              <label for="validationCustom02">Vorname</label>
                                              <input type="text" class="form-control" name="form_firstname" id="form_firstname" placeholder="Vorname" required>
                                          </div><!--end col-->
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Nachname</label>
                                                <input type="text" class="form-control" name="form_surname" id="form_surname" placeholder="Nachname" required>
                                            </div><!--end col-->
                                      </div><!--end form-row-->
                                      <div class="form-row">
                                          <div class="col-md-4 mb-3">
                                              <label for="validationCustom02">E-Mail</label>
                                              <input type="mail" class="form-control" name="form_email" id="form_email" placeholder="E-Mail" required>
                                          </div><!--end col-->
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom02">Passwort</label>
                                            <input type="password" class="form-control" name="form_password" id="form_password" placeholder="Passwort" required>
                                        </div><!--end col-->
                                      </div>
                                      <button class="btn btn-primary" type="submit">Benutzer Hinzufügen</button>
                                  </form> <!--end form-->
                                  <?php
                                if (empty($_GET["status"])) {

                                } else if ($_GET["status"] == 1) {
                                  echo '<div class="card-body">
                                    <div class="alert alert-success border-0" role="alert">
                                    <strong>Fertig!</strong> Der Benutzer wurde hinzugefügt
                                    </div>
                                    </div><!--end card-body-->';
                                    }

                                  ?>
                              </div><!--end card-body-->
                          </div><!--end card-->
                      </div><!--end col-->
                  </div>


                </div><!-- container -->

                <footer class="footer text-center text-sm-left">Baltic NetWorks &copy; <?php echo date("Y"); ?></span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->




        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/js/moment.js"></script>
        <script src="../plugins/daterangepicker/daterangepicker.js"></script>

        <!-- Required datatable js -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>
        <script src="../plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/pages/jquery.datatable.init.js"></script>

        <!-- Parsley js -->
        <script src="../plugins/parsleyjs/parsley.min.js"></script>
        <script src="assets/pages/jquery.validation.init.js"></script>
        <script src="../plugins/x-editable/js/bootstrap-editable.min.js"></script>
        <script src="assets/pages/jquery.form-xeditable.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
       <script src="assets/js/jquery.core.js"></script>

    </body>

</html>
