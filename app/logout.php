<?php
$designcode = htmlspecialchars($_COOKIE['theme_id']);
if ($designcode == "0") {
  echo ('<style>
body {
  background-color: white;
}
</style>');
} else if ($designcode == "1") {
  echo ('<style>
body {
  background-color: grey;
}
</style>');
} else {
  echo ('<style>
body {
  background-color: white;
}
</style>');
}
//Cookies Löschen und Weiterleitung
  setcookie ("access_token", "", time() -1);
  setcookie ("theme_id", "", time() -1);
  header ("Refresh: 0; index.php");
?>
