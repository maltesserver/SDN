<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");
?>
<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <title>SDN - Einstellungen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="SDN" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                        <h4 class="page-title">Einstellungen</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">System</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Einstellungen</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    <div class="pb-4">
                        <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="options_profile_tab" data-toggle="pill" href="#options_profile">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="options_security_tab" data-toggle="pill" href="#options_security">Sicherheit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="options_design_tab" data-toggle="pill" href="#options_design">Design</a>
                            </li>
                        </ul>
                    </div><!--end card-body-->
                    <?php

                    if (empty($_GET["status"])) {

                  if (!(empty($_GET["action"]))) {
                   if ($_GET["action"] == 1 && $_GET["status"] == 1){
                      echo '<div class="card-body">
                        <div class="alert alert-success border-0" role="alert">
                        <strong>Fertig!</strong> Die Einstellungen wurden gespeichert
                        </div>
                        </div><!--end card-body-->';
                    } else if ($_GET["action"] == 2) {
                      if ($_GET["status"] == 1) {
                        echo '<div class="card-body">
                        <div class="alert alert-success border-0" role="alert">
                        <strong>Fertig!</strong> Die Einstellungen wurden gespeichert
                        </div>
                        </div><!--end card-body-->';
                      } else if ($_GET["status"] == 0) {
                        echo '<div class="card-body">
                            <div class="alert alert-danger border-0" role="alert">
                            <strong>Fehler!</strong> '.$_GET["msg"].'
                            </div>
                            </div><!--end card-body-->';
                      } else {
                        echo '<div class="card-body">
                            <div class="alert alert-danger border-0" role="alert">
                            <strong>Fehler!</strong> Es ist ein Fehler aufgetreten!
                            </div>
                            </div><!--end card-body-->';
                      }
                    }
                  }
                  } else if ($_GET["status"] == 1) {
                    echo '<div class="card-body">
                      <div class="alert alert-success border-0" role="alert">
                      <strong>Fertig!</strong> Die Einstellungen wurden gespeichert
                      </div>
                      </div><!--end card-body-->';
                  }


                    ?>

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="options_profile" role="tabpanel" aria-labelledby="options_profile_tab">
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="card-title">Dein Profil</h4>
                                            </div><!--end col-->
                                        </div>  <!--end row-->
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                      <form>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Vorname</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" type="text" value="Max">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Nachname</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" type="text" value="Musterman">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Firmenname</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" type="text" value="Streamline"  disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Handynummer</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="las la-phone"></i></span></div>
                                                    <input type="text" class="form-control" value="+49 125 45654" placeholder="Phone" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">E-mail</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="las la-at"></i></span></div>
                                                    <input type="text" class="form-control" value="user@domain.de" placeholder="Email" aria-describedby="basic-addon1"   disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Webseite</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-globe"></i></span></div>
                                                    <input type="text" class="form-control" value=" https://Streamline.de" placeholder="Email" aria-describedby="basic-addon1"   disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Standort</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <select class="form-control">
                                                    <option>Deutschland</option>
                                                    <option>USA</option>
                                                    <option>Canada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                <button type="submit" class="btn btn-primary btn-sm">Daten &Auml;ndern</button>
                                                <button type="button" class="btn btn-danger btn-sm" href="home.php">Abbruch</button>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            </div> <!--end col-->
                          </div>
                        </div>
                      <div class="tab-pane fade" id="options_security" role="tabpanel" aria-labelledby="options_security_tab">
                            <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Passwort &Auml;ndern</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                  <form class="needs-validation" novalidate method="post" action="pw-change-user.php">
                                    <input type=hidden name=todo value=change-password>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Aktuelles Passwort</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" name="old_password" type="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Neues Passwort</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" name="password" type="password" placeholder="Neues Passwort">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right mb-lg-0 align-self-center">Neues Passwort best&auml;tigen</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" name="password2" type="password" placeholder="Neues Passwort best&auml;tigen">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                <button type="submit" class="btn btn-primary btn-sm">Passwort &Auml;ndern</button>
                                                <button type="button" class="btn btn-danger btn-sm" href="home.php">Abbruch</button>
                                            </div>
                                        </div>
                                      </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                              </div>
                            </div>
                        </div>
                            <div class="tab-pane fade" id="options_design" role="tabpanel" aria-labelledby="options_design_tab">
                              <div class="row">
                              <div class="col-lg-6 col-xl-6">
                                  <div class="card">
                                  <div class="card-header">
                                      <h4 class="card-title">Design</h4>
                                  </div><!--end card-header-->
                                  <div class="card-body">
                                    <form novalidate method="post" action="design-change.php">
                                        <input type=hidden name=todo value=change-design>

                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-8">
                                                <select class="form-control" name="form_design" id="form_design">
                                                    <option value="0">White-Mode</option>
                                                    <option value="1">Dark-Mode</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Design Ändern</button>
                                        </div>
                                      </form>
                                  </div><!--end card-body-->
                              </div><!--end card-->
                            </div>
                        </div><!--end row-->
                      </div>

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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>
