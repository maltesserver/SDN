<?php
if(isset($_COOKIE['access_token'])) {
  if(!(isTokenValid($_COOKIE['access_token']))){
    header("Location: logout.php");
    exit;
  }
}else{
  header("Location: index.php");
  exit;
}
$data = getTokenUserData($_COOKIE['access_token']);

if($data == []){
  header("Location: logout.php");
  exit;
}

$user = $data->data;

$name = $user->name;
$user_id = $user->user_id;
$email = $user->email;
$rights_id = $user->rights_id;
?>
