<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");

$usernamecookie = $name;
///////Collect the form data /////
$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$old_password=$_POST['old_password'];
/////////////////////////


if(isset($todo) and $todo=="change-password"){

$status = true;
$msg="";


$user_stantment = $pdo->prepare("SELECT * FROM user_users WHERE ".$name);
$user_stantment->execute();

$row2 = $user_stantment->fetchAll();

foreach ($row2 as $row) {
  $useridfromdb = htmlspecialchars($row["ID"]);
  $usernamefromdb = htmlspecialchars($row["name"]);
  $passwordfromdb = htmlspecialchars($row["password"]);
}

//Password Verschlüsseln
$pwhashcode = password_hash($password, PASSWORD_DEFAULT);


if ($password !== $password2){
  $msg="Die Passwörter stimmen nicht überein.";
  $status=false;
}

if ($status && strlen($password) < 3 or strlen($password) > 128){
  $msg="Das Passwort ist zu kurz oder zu lang.";
  $status=false;
}

if ($status && !strtolower(trim($pwhashcode)) === strtolower(trim($passwordfromdb))) {

    $msg="Das alte Passwort passt nicht.";
    $status=false;
}
if ($status == true){
//Wenn alles stimmt, neues Passwort speichern in der Datenbank
$changepwpdo = $pdo->prepare("UPDATE user_users set password = :pwhashcode WHERE name = :username");
$changepwpdo->bindParam(":pwhashcode", $pwhashcode);
$changepwpdo->bindParam(":username", $name);
$changepwpdo->execute();

}
}
header("Location: options.php?status=".$status."&action=2&msg=".$msg);
die();

?>
