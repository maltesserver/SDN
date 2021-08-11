<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");
?>
<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <title>SDN - Geräte Liste</title>
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
                                        <h4 class="page-title">Geräte Liste</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">System</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Geräte Liste</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->




                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Geräte Liste</h4>
                                    <p class="text-muted mb-0">Hier sind alle Geräte aufgelistet, ein CSV und PDF Export ist möglich.
                                    </p>
                                </div><!--end card-header-->
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Hostname</th>
                                            <th>IP</th>
                                            <th>Status</th>
                                            <th>Verwalten</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php
                                        //Ausgeben aller Geräte in der Datenbank
                                        $user_stantment = $pdo->prepare('SELECT * FROM devices');
                                        $user_stantment->execute();
                                         $row2 = $user_stantment->fetchAll();
                                         foreach ($row2 as $row) {
                                           $id = htmlspecialchars($row["ID"]);
                                           $name = htmlspecialchars($row["Name"]);
                                           $device_ip = htmlspecialchars($row["IP"]);
                                           $device_user = htmlspecialchars($row["User"]);
                                           $device_password = htmlspecialchars($row["Password"]);
                                           $device_shell_port = htmlspecialchars($row["Shell_Port"]);

                                           //Pingen aller IPs und Status setzen
                                           if (!@$fp = fsockopen($device_ip, $device_shell_port, $errno, $errstr, 1)){
                                             $device_current_status='<span class="badge badge-soft-danger">Offline</span>';
                                             $device_edit_button='<button type="button" class="btn btn-outline-secondary waves-effect waves-light"><i class="mdi mdi-power mr-2"></i>Verwalten</button>';
                                           } else {
                                             $device_current_status='<span class="badge badge-soft-success">Online</span>';
                                             $device_edit_button='<a href="device-manage.php?device='.$id.'"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="mdi mdi-send mr-2"></i>Verwalten</button></a>';
                                           }

                                           echo  '<tr>
                                               <td>'. $id .'</td>
                                               <td>'. $name .'</td>
                                               <td>Localhost</td>
                                               <td>'.$device_ip.'</td>
                                               <td>'. $device_current_status .'</td>
                                               <td><div class="button-items">'. $device_edit_button .'</div></td>
                                           </tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>
