<?php

require_once("../config.php");

try{
  $pdo = new PDO("mysql:host=".$config['mysql_host'].";port=".$config['mysql_port'].";dbname=".$config['mysql_db'], $config['mysql_user'],$config['mysql_password']);
}catch(Exception $e){
  echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}

function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 16; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}
?>
