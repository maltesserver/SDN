<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");
include '../vendor/autoload.php';
use phpseclib3\Net\SSH2;
?>
<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <title>SDN - Gerät Verwalten</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="SDN" name="description" />
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
                                        <h4 class="page-title">Gerät Verwalten</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">System</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Gerät Verwalten</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="card">
                                          <div class="card-header">
                                              <h4 class="card-title">Gerät Verwalten</h4>
                                              <p class="text-muted mb-0">Hier kannst du das Gerät Verwalten und dich mit der WebConsole Anmelden.
                                              </p>
                                          </div><!--end card-header-->
                                      </div>
                                  </div> <!-- end col -->
                              </div> <!-- end row -->
                              <?php

                              $device_id = $_GET["device"];

                              $user_stantment = $pdo->prepare('SELECT * FROM devices WHERE ID = :device_id');
                              $user_stantment->bindParam(":device_id", $device_id);
                              $user_stantment->execute();
                              $row2 = $user_stantment->fetchAll();

                              //Foreach Test (Wegen Bug drin gelassen)
                              foreach ($row2 as $row) {
                                $device_id = htmlspecialchars($row["ID"]);
                                $name = htmlspecialchars($row["Name"]);
                                $device_ip = htmlspecialchars($row["IP"]);
                                $device_user = htmlspecialchars($row["User"]);
                                $device_password = htmlspecialchars($row["Password"]);
                                $device_shell_port = htmlspecialchars($row["Shell_Port"]);
                                //Überprüfen, ob es das Gerät gibt und ausgeben der Funktionen
                              if (empty($row2)) {
                                echo '<div class="card-body">
                                  <div class="alert alert-danger border-0" role="alert">
                                  <strong>Fehler!</strong> Das Gerät wurde nicht gefunden.
                                  </div>
                                  </div>';
                              } else {
                                echo '
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title">Verwaltung</h4>
                                                    <p class="text-muted mb-0">Hier kannst du das Gerät Verwalten und auch eine Shell Sitzung starten.</p>
                                                </div><!--end col-->
                                            </div>  <!--end row-->
                                        </div><!--end card-header-->
                                        <div class="card-body">
                                            <div class="button-items">
                                                <button type="button" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-restart mr-2"></i>Gerät Neustarten</button>
                                                <button type="button" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-stop-circle-outline mr-2"></i>Gerät Herunterfahren</button>
                                            </div>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->


                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title">Shell</h4>
                                                    <p class="text-muted mb-0">Hier kannst du die Shell oder FTP öffnen.</p>
                                                </div><!--end col-->
                                            </div>  <!--end row-->
                                        </div><!--end card-header-->
                                        <div class="card-body">
                                            <div class="button-items">

                                                <a href="ssh://'.$device_ip.':'.$device_shell_port.'"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="mdi mdi-console-line mr-2"></i>Shell Öffnen</button></a>
                                                <a href="'.$config['ftp_protocol'].'://'.$device_ip.':'.$device_shell_port.'"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="mdi mdi-console-line mr-2"></i>FTP Öffnen</button></a>
                                              </div>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title">Diagnose</h4>
                                                    <p class="text-muted mb-0">Starte eine erste Fehlerdiagnose aus.</p>
                                                </div><!--end col-->
                                            </div>  <!--end row-->
                                        </div><!--end card-header-->
                                        <div class="card-body">
                                            <div class="button-items">
                                                <form method="post" action="get-ping.php" name="pingdeviceform">
                                                  <input type=hidden name=todo value=get-ping>
                                                  <input type=hidden name="post_device_id" value='.$device_id.'>
                                                <input type=hidden name="post_device_ip" value='.$device_ip.'>
                                                <input type=hidden name="post_device_port" value='.$device_shell_port.'>
                                                <button type="button submit" class="btn btn-outline-primary waves-effect waves-light" name="ping_test_form"><i class="mdi mdi-map-marker-distance mr-2"></i>Ping Starten</button>
                                                </form>
                                                    <form class="needs-validation" novalidate method="post">
                                                      <input type=hidden name=todo value=send-cmd>
                                                          <div class="col-md-6 mb-3">
                                                              <label for="validationCustom01">Befehl senden</label>
                                                                <input type=hidden name=todo value=send-cmd>
                                                              <input type=hidden name="post_device_id" value='.$device_id.'>
                                                              <input type=hidden name="post_device_name" value='.$name.'>
                                                            <input type=hidden name="post_device_ip" value='.$device_ip.'>
                                                            <input type=hidden name="post_device_port" value='.$device_shell_port.'>
                                                            <input type=hidden name="post_device_user" value='.$device_user.'>
                                                            <input type=hidden name="post_device_password" value='.$device_password.'>
                                                              <input type="text" class="form-control" name="form_device_command" id="form_device_command" placeholder="Befehl" required>
                                                          </div><!--end col-->
                                                          <button class="btn btn-primary" type="submit">Befehl ausführen</button>
                                                      </form> <!--end form-->
                                            </div>
                                            ';
                                            if (empty($_GET["action"])) {

                                            } else if ($_GET["action"] == "ping") {
                                              if ($_GET["devicestatus"] == "Online") {
                                              echo '<div class="card-body">
                                                <div class="alert alert-success border-0" role="alert">
                                                <strong>Fertig!</strong> Das Gerät mit der IP '.$_GET["deviceip"].' (Port '.$_GET["deviceport"].') ist '.$_GET["devicestatus"].' und hat eine Latenz von '.$_GET["devicelatency"].'.
                                                </div>
                                                </div><!--end card-body-->';
                                              } else {
                                              echo '<div class="card-body">
                                                <div class="alert alert-danger border-0" role="alert">
                                                <strong>Fehler!</strong> Das Gerät ist Offline!
                                                </div>
                                                </div><!--end card-body-->';
                                              }
                                                }
                                            echo '
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->';

                                if (empty($_GET["status"])) {

                                } else if ($_GET["status"] == 1) {
                                  echo '<div class="card-body">
                                    <div class="alert alert-success border-0" role="alert">
                                    <strong>Fertig!</strong> Der Download wurde gestartet
                                    </div>
                                    </div><!--end card-body-->';
                                    }
                              }
                            }

                              ?>
                              <?php
                              //Web Befehl Ausgabe
                                  if(isset($_POST['form_device_command']) && !empty($_POST['post_device_password']) AND isset($_POST['post_device_ip']) && !empty($_POST['post_device_user'])){



                                    ///////Collect the form data /////
                                    $todo=$_POST['todo'];
                                    $post_device_id=$_POST['post_device_id'];
                                    $post_device_name=$_POST['post_device_name'];
                                    $post_device_ip=$_POST['post_device_ip'];
                                    $post_device_port=$_POST['post_device_port'];
                                    $post_device_user=$_POST['post_device_user'];
                                    $post_device_password=$_POST['post_device_password'];
                                    $form_device_command=$_POST['form_device_command'];
                                    /////////////////////////

                                    //Form Überprüfung
                                    if(isset($todo) and $todo=="send-cmd"){

                                    //Benötigte Daten Festlegen und Composer Dateien Sammeln

                                    error_reporting(E_ALL);
                                    ini_set("display_errors", 1);

                                    spl_autoload_extensions('.php');
                                    spl_autoload_register();

                                    //session_start();

                                    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');


                                    //Befehl per SSH Senden
                                    $ssh = new SSH2($post_device_ip, $post_device_port);
                                    if (!$ssh->login($post_device_user, $post_device_password)) {
                                        echo 'Error';
                                    }else{
                                      $ssh->write($form_device_command . "\n");
                                      $ssh->setTimeout(10);

                                      //SSH Output lesen
                                      $output = $ssh->read();
                                    echo '<!--start -->
                                    <div class="card mt-3">
                                          <div class="card-body">

                                              <div class="media mb-4">
                                                  <div class="media-body align-self-center">
                                                      <h5 class="font-14 m-0">SSH Output</h5>
                                                  </div>
                                              </div>'.
                                      //while (@ ob_end_flush()); // end all output buffers if any
                                      //SSH Output schreiben
                                      $proc = popen($output, 'r');
                                      echo '<div id="features" class="tabs">
                                      <div class="container"><pre>';
                                      while (!feof($proc))
                                      {
                                          echo "<script>console.log('SSH Befehl wurde ausgeführt.' );</script>";
                                          echo fread($proc, 4096);
                                          echo '<p>'.$output.'</p>';
                                          @ flush();
                                      }
                                      echo '</pre>
                                      </div>
                                </div>';
                                    }
                                    }

                                  }

                              ?>

                                <!--end-->
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->


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
