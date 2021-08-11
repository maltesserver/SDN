<?php
require_once('../vendor/autoload.php');

use Firebase\JWT\JWT;

function createNewUserToken($id, $username, $email, $ip_address, $rights_id){
  $secret_key = "19fa61d75522a4669b44e39c1d2e1719fa61d75522a4669b44e39c1d2e1726c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb326c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb3";


  $issuedat_claim = time();
  $issuer_claim = "sdn.projects.realtox.de";
  $audience_claim = "sdn.projects.realtox.de";
  $notbefore_claim = $issuedat_claim;
  $expire_claim = $issuedat_claim + 3600; // expire time in seconds

  $token = array(
    "iss" => $issuer_claim,
    "aud" => $audience_claim,
    "iat" => $issuedat_claim,
    "nbf" => $notbefore_claim,
    "exp" => $expire_claim,
    "data" => array(
        "user_id" => $id,
        "name" => $username,
        "email" => $email,
        "ip_address" => $ip_address,
        "rights_id" => $rights_id,
  ));
  $jwt = JWT::encode($token, $secret_key);
  return $jwt;
}

function isTokenValid($token){
  try {
    $secret_key = "19fa61d75522a4669b44e39c1d2e1719fa61d75522a4669b44e39c1d2e1726c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb326c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb3";

    $decoded = JWT::decode($token, $secret_key, array('HS256'));
    return true;
  }catch (Exception $e){
    return false;
  }
}

function getTokenUserData($token){
  try {
    $secret_key = "19fa61d75522a4669b44e39c1d2e1719fa61d75522a4669b44e39c1d2e1726c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb326c530232130d407f89afee0964997f7a73e83be698b288febcf88e3e03c4f0757ea8964e59b63d93708b138cc42a66eb3";

    $decoded = JWT::decode($token, $secret_key, array('HS256'));
    return $decoded;
  }catch (Exception $e){
    return [];
  }
}


?>
