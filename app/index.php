
<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <title>SDN - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="SDN" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/sdn-favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                       <a href="index.html" class="logo logo-admin">
                                            <img src="assets/images/sdn-logo.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">SDN Login</h4>
                                        <p class="text-muted  mb-0">Melde dich an um fortzufahren.</p>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav-border nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#LogIn_Tab" role="tab">Log In</a>
                                        </li>
                                    </ul>
                                    <?php

                                        require_once("config/config.php");
                                        require_once("config/jwt.php");

                                        if(isset($_COOKIE['access_token'])) {
                                          header('Location: home.php');
                                        }

                                        if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
                                          $name = htmlspecialchars($_POST['email']);
                                          $password = htmlspecialchars($_POST['password']);
                                          $email = $_POST['email'];


                                          #$login_stantment = $pdo->prepare("SELECT * FROM user_users WHERE name LIKE :name OR email LIKE :name");
                                          $login_stantment = $pdo->prepare("SELECT * FROM user_users WHERE email = :name");
                                          $login_stantment->bindParam("name", $name);
                                          $login_stantment->execute();
                                          $user = $login_stantment->fetch();
                                          if($user != null && password_verify($password, $user['password'])){


                                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                $ip = $_SERVER['HTTP_CLIENT_IP'];
                                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            } else {
                                                $ip = $_SERVER['REMOTE_ADDR'];
                                            }

                                            $token = createNewUserToken($user['ID'], $user['name'], $user['email'], $ip, $user['rights_id']);

                                            setcookie("access_token", $token, time()+3600);

                                            setcookie("theme_id", $user['current_theme'], time()+3600);

                                          	header('Location: home.php');
                                          }else{

                                          	echo('<div class="card-body">
                                    <div class="alert alert-danger border-0" role="alert">
                                        <strong>Falsche Daten!</strong> Die E-Mail oder das Passwort stimmt nicht
                                    </div>
                                </div><!--end card-body--> ');
                                          }
                                        }

                                    ?>
                                     <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form" method="post" name="loginForm" novalidate>

                                               <div class="form-group mb-2">
                                                    <label for="username">Deine E-Mail</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="email" id="loginFormInputEmail" placeholder="User@domain.de">
                                                    </div>
                                                </div><!--end form-group-->

                                                <div class="form-group mb-2">
                                                    <label for="userpassword">Dein Passwort</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="password" id="loginFormInputPassword" placeholder="Dein Passwort">
                                                    </div>
                                                </div><!--end form-group-->

                                                <div class="form-group row my-3">
                                                    <div class="col-sm-6">
                                                        <div class="custom-control custom-switch switch-success">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                            <label class="custom-control-label text-muted" for="customSwitchSuccess">90 Tage die Anmeldung Speichern</label>
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-sm-6 text-right">
                                                        <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Passwort Vergessen?</a>
                                                    </div><!--end col-->
                                                </div><!--end form-group-->

                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Anmelden <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                    </div><!--end col-->
                                                </div> <!--end form-group-->
                                            </form><!--end form-->
                                        </div>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Baltic NetWorks &copy; <?php echo date("Y"); ?></span>
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->




        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>


    </body>

</html>
