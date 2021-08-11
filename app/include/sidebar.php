<!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li class="menu-label mt-0">Main</li>
                <li>
                    <a href="home.php"><i data-feather="home" class="align-self-center menu-icon"></i><span>Home</span></a>
                </li>
                <?php
                if ($rights_id == "2") {
                  echo ('<hr class="hr-dashed hr-menu">
                  <li class="menu-label my-2">Benutzer</li>

                  <li>
                      <a href="javascript: void(0);"><i data-feather="users" class="align-self-center menu-icon"></i><span>Benutzer</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li class="nav-item"><a class="nav-link" href="users.php"><i class="ti-control-record"></i>Benutzerübersicht</a></li>
                          <li class="nav-item"><a class="nav-link" href="user-add.php"><i class="ti-control-record"></i>Benutzer hinzufügen</a></li>
                      </ul>
                  </li>');
                }
                ?>


                <hr class="hr-dashed hr-menu">
                <li class="menu-label my-2">Geräteverwaltung</li>

                <li>
                    <a href="javascript: void(0);"><i data-feather="tool" class="align-self-center menu-icon"></i><span>Geräte</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="device-list.php"><i class="ti-control-record"></i>Geräte Liste</a></li>
                        <li class="nav-item"><a class="nav-link" href="device-add.php"><i class="ti-control-record"></i>Gerät Hinzufügen</a></li>
                    </ul>
                </li>
            </ul>

            <div class="update-msg text-center">
                <a href="javascript: void(0);" class="float-right close-btn text-muted" data-dismiss="update-msg" aria-label="Close" aria-hidden="true">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="mt-3">Lizenzstatus</h5>
                <p class="mb-3">Die Lizenz ist <span class="badge badge-soft-success menu-arrow">Aktiv</span></p>
                <p class="mb-3">Der Lizenzserver ist <span class="badge badge-soft-success menu-arrow">Online</span></p>
            </div>
        </div>
    </div>
    <!-- end left-sidenav-->
