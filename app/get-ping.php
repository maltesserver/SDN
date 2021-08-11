<?php
require_once("config/config.php");
require_once("config/jwt.php");
require_once("config/auth.php");
require_once("../config.php");


///////Collect the form data /////
$todo=$_POST['todo'];
$form_device_ip=$_POST['post_device_ip'];
$form_device_port=$_POST['post_device_port'];
$form_device_id=$_POST['post_device_id'];
/////////////////////////


if(isset($todo) and $todo=="get-ping"){

  //API cURL Abfrage starten
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => $config['api_location'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
  'device_ip: '.$form_device_ip,
  'device_port: '.$form_device_port,
  'Auth-Token: '.$config['api_key']
  ),
  ));

  $response = curl_exec($curl);
  //JSON Decode
  curl_close($curl);
  $responset = json_decode($response, true);

  foreach($responset AS $arrayoutput) {
    $array_device_ip = $responset["device_ip"];
    $array_device_port = $responset["device_port"];
    $array_device_status = $responset["device_status"];
    $array_device_latency = $responset["latency"];
  }
//Weiterleitung
header("Location: device-manage.php?device=".$form_device_id."&status=2&action=ping&deviceip=".$array_device_ip."&deviceport=".$array_device_port."&devicestatus=".$array_device_status."&devicelatency=".$array_device_latency);
die();

}
?>
