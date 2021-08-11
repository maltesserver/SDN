<?php
//.css Wählen
//app.css -> Whitemode
//app-dark.css -> Darkmode
$designcode = htmlspecialchars($_COOKIE['theme_id']);
if ($designcode == "0") {
  echo ('<link href="assets/css/app.css" rel="stylesheet" type="text/css" />');
} else if ($designcode == "1") {
  echo ('<link href="assets/css/app-dark.css" rel="stylesheet" type="text/css" />');
} else {
  echo ('<link href="assets/css/app.css" rel="stylesheet" type="text/css" />');
}
?>
