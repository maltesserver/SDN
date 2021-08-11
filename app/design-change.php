<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");


///////Collect the form data /////
$todo=$_POST['todo'];
$form_design=$_POST['form_design'];
/////////////////////////

//Form Überprüfung
if(isset($todo) and $todo=="change-design"){

//SQL Befehl
$changedesign = $pdo->prepare("UPDATE user_users set current_theme = :designcode WHERE name = :username");
$changedesign->bindParam(":designcode", $form_design);
$changedesign->bindParam(":username", $name);
$changedesign->execute();
//Cookie neu setzen
setcookie ("theme_id", "", time() -1);
setcookie("theme_id", $form_design, time()+3600);

//Weiterleitung
header("Location: options.php?status=1&action=2");
die();

}
?>
