<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");


///////Collect the form data /////
$todo=$_POST['todo'];
$form_device_name=$_POST['form_device_name'];
$form_device_ip=$_POST['form_device_ip'];
$form_device_user=$_POST['form_device_user'];
$form_device_password=$_POST['form_device_password'];
$form_device_port=$_POST['form_device_port'];
/////////////////////////

//Form Überprüfung
if(isset($todo) and $todo=="add-device"){

//SQL Befehl
$addservice = $pdo->prepare("INSERT INTO devices(Name, IP, User, Password, Shell_Port, current_theme) VALUES (:name, :ip, :user, :password, :shell_port, 1)");
$addservice->bindParam(":name", $form_device_name);
$addservice->bindParam(":ip", $form_device_ip);
$addservice->bindParam(":user", $form_device_user);
$addservice->bindParam(":password", $form_device_password);
$addservice->bindParam(":shell_port", $form_device_port);
$addservice->execute();

//Weiterleitung
header("Location: device-add.php?status=1");
die();

}
?>
