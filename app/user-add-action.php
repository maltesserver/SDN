<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");


///////Collect the form data /////
$todo=$_POST['todo'];
$form_username=$_POST['form_username'];
$form_firstname=$_POST['form_firstname'];
$form_surname=$_POST['form_surname'];
$form_email=$_POST['form_email'];
$form_password=$_POST['form_password'];
/////////////////////////


if(isset($todo) and $todo=="add-user"){

//Passwort Verschlüsseln
$form_password_crypted = password_hash($form_password, PASSWORD_DEFAULT);

//Benutzer in der Datenbank anlegen
$adduser = $pdo->prepare("INSERT INTO user_users(name, firstname, surname, email, password, rights) VALUES (:username, :firstname, :surname, :email, :password_crypted, 0)");
$adduser->bindParam(":username", $form_username);
$adduser->bindParam(":firstname", $form_firstname);
$adduser->bindParam(":surname", $form_surname);
$adduser->bindParam(":email", $form_email);
$adduser->bindParam(":password_crypted", $form_password_crypted);
$adduser->execute();

//Weiterleitung
header("Location: user-add.php?status=1");
die();

}
?>
