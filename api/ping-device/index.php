<?php
require_once("../config/database.php");
require_once("../config/core.php");

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

$CONFIG = array(
    "API_Enabled" => $apistatus,
);
$api = array(
  "code" => 200
);

if (!$CONFIG["API_Enabled"]) {
    $api["code"] = 501;
    $api["ct"] = "API is currenty disabled!";
    http_response_code($api["code"]);
    echo json_encode($api, JSON_PRETTY_PRINT);
    exit();
}

$api["message"] = getHTTPCode($api["code"]);

$api["request_url"] = $_SERVER['REQUEST_URI'];

$headers = apache_request_headers();
$api_key = $headers["Auth-Token"];

if ($api_key > 5) {
      $api["code"] = 401;
      $api["ct"] = "Unauthorized";
      http_response_code($api["code"]);
      echo json_encode($api, JSON_PRETTY_PRINT);
} else {

$user_stantment = $pdo->prepare("SELECT * FROM api_keys WHERE API_KEY LIKE :authtoken");
$user_stantment->bindParam(":authtoken", $api_key);
$user_stantment->execute();
$row2 = $user_stantment->fetchAll();
if (!$row2) {
  $api["code"] = 401;
  $api["message"] = "Unauthorized";
  $api["ct"] = "Unauthorized";
  http_response_code($api["code"]);
  echo json_encode($api, JSON_PRETTY_PRINT);
} else {
foreach ($row2 as $row) {

  $id = htmlspecialchars($row["ID"]);
  $apikey = htmlspecialchars($row["API_KEY"]);
  $useractiv = htmlspecialchars($row["API_STATUS"]);

}
if ($useractiv == "1") {
  /**
   * Ping Device File
   *
   * @author  Felix Gassan
   * @link    https://realtox.de
   * @version 1.0
   */
  class hldsStatus
  {

      /**
       * Server IP
       * @var string
       */
      protected $ip;

      /**
       * Server port
       * @var int
       */
      protected $port;

      /**
       * Server latency
       * @var int
       */
      protected $latency;

      /**
       * Socket holder
       * @var ??
       */
      protected $sock;

      /**
       * Check if specified server is online
       *
       * @access  public
       * @param   string  $address    Server address
       * @param   int     $timeout    Socket timeout (optional)
       * @return  string
       */
      public function status($address, $timeout = 6)
      {
          $this->_parseAddr($address);

          if ($this->sock = @fsockopen('tcp://'.$this->ip, $this->port, $errno, $errstr, $timeout))
          {
              $startTime = microtime(true);

              stream_set_timeout($this->sock, $timeout);
  fwrite($this->sock, "\xFF\xFF\xFF\xFFTSource Engine Query".chr(0));
  fread($this->sock, 5);
  $status = 'Online';
  fclose($this->sock);

  $stopTime  = microtime(true);
  $this->latency = number_format( ($stopTime - $startTime) * 1000, 3);
  }
  else
  {
  $status = 'Offline';
  }

          return $status;
      }

      /**
       * Get the server latency
       *
       * @access  public
       * @param   string  $address
       * @return  int       -1 on error
       */
      public function ping($address = null)
      {
          if (!is_numeric($this->port))
          {
              if (is_null($address))
              {
                  throw new Exception('Es wurde keine IP eingegeben!');
              }

              $this->status($address);
          }

          return (is_numeric($this->latency)) ? $this->latency : '-';
      }

      /**
       * Extract IP and Port
       *
       * @access  private
       * @param   string  $address
       * @return  void
       */
      private function _parseAddr($address)
      {
        $headers = apache_request_headers();
        $device_port = $headers["device_port"];
          if (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE))
          {
              $this->ip   = $address;
              $this->port = $device_port;
          }
          else
          {
              $pcs        = explode(':', $address);
              $this->ip   = gethostbyname($pcs[0]);
              $this->port = (isset($pcs[1])) ? $pcs[1] : $device_port;
          }
      }

      /**
       * Cleanup
       */
      public function __destruct()
      {
          if (!is_null($this->sock))
          {
              $this->sock = $this->ip = $this->port = null;
          }
      }
  }

  /**
   * Output
   */
  $server = new hldsStatus();
  $headers = apache_request_headers();
  $device_ip = $headers["device_ip"];
  $final_result = $server->status($device_ip).' - '.$server->ping().' ms';
  $device_status = $server->status($device_ip);
  $device_latency = $server->ping().'ms';

$array = array('device_ip' => $headers["device_ip"],
'device_port' => $headers["device_port"],
'device_status' => $device_status,
'latency' => $device_latency);

    http_response_code($api["code"]);
    echo json_encode(array_merge($api, $array), JSON_PRETTY_PRINT);

} else {
  $api["code"] = 403;
  $api["message"] = "Forbidden";
  $api["ct"] = "Forbidden";
  http_response_code($api["code"]);
  echo json_encode($api, JSON_PRETTY_PRINT);
}
}
}


/* Returns the Message for given HTTP Status code*/
function getHTTPCode($code)
{
    $msg = "";
    switch ($code) {
        case 100:
            $msg = "Continue";
            break;
        case 101:
            $msg = "Switching Protocols";
            break;
        case 102:
            $msg = "Processing";
            break;
        case 103:
            $msg = "Early Hints";
            break;

        case 200:
            $msg = "OK";
            break;
        case 201:
            $msg = "Created";
            break;
        case 202:
            $msg = "Accepted";
            break;
        case 203:
            $msg = "Non-Authoritative Information";
            break;
        case 204:
            $msg = "No Content";
            break;
        case 205:
            $msg = "Reset Content";
            break;
        case 206:
            $msg = "Partial Content";
            break;
        case 207:
            $msg = "Multi-Status";
            break;
        case 208:
            $msg = "Already Reported";
            break;
        case 209:
            $msg = "IM Used";
            break;

        case 300:
            $msg = "Multiple Choices";
            break;
        case 301:
            $msg = "Moved Permanently";
            break;
        case 302:
            $msg = "Found (Moved Temporarily)";
            break;
        case 303:
            $msg = "See Other";
            break;
        case 304:
            $msg = "Not Modified";
            break;
        case 305:
            $msg = "Use Proxy";
            break;
        case 306:
            $msg = "(reserviert)";
            break;
        case 307:
            $msg = "Temporary Redirect";
            break;

        case 400:
            $msg = "Bad Request";
            break;
        case 401:
            $msg = "Unauthorized";
            break;
        case 402:
            $msg = "Payment Required";
            break;
        case 403:
            $msg = "Forbidden";
            break;
        case 404:
            $msg = "Not Found";
            break;
        case 405:
            $msg = "Method Not Allowed";
            break;
        case 406:
            $msg = "Not Acceptable";
            break;
        case 407:
            $msg = "Proxy Authentication Required";
            break;
        case 408:
            $msg = "Request Timeout";
            break;
        case 409:
            $msg = "Conflict";
            break;
        case 410:
            $msg = "Gone";
            break;
        case 411:
            $msg = "Length Required";
            break;
        case 412:
            $msg = "Precondition Failed";
            break;
        case 413:
            $msg = "Payload Too Large";
            break;
        case 414:
            $msg = "URI Too Long";
            break;
        case 415:
            $msg = "Unsupported Media Type";
            break;
        case 416:
            $msg = "Range Not Satisfiable";
            break;
        case 417:
            $msg = "Expectation Failed";
            break;
        case 421:
            $msg = "Misdirected Request";
            break;
        case 422:
            $msg = "Unprocessable Entity";
            break;
        case 423:
            $msg = "Locked";
            break;
        case 424:
            $msg = "Failed Dependency";
            break;
        case 425:
            $msg = "Too Early";
            break;
        case 426:
            $msg = "Upgrade Required";
            break;
        case 428:
            $msg = "Precondition Required";
            break;
        case 429:
            $msg = "Too Many Requests";
            break;
        case 431:
            $msg = "Request Header Fields Too Large";
            break;
        case 451:
            $msg = "Unavailable For Legal Reasons";
            break;
        //NEW HEADERS - SINCE JULY 2020
        case 418:
            $msg = "I’m a teapot";
            break;
        case 420:
            $msg = "Policy Not Fulfilled";
            break;
        case 444:
            $msg = "No Response";
            break;
        case 449:
            $msg = "The request should be retried after doing the appropriate action";
            break;

        case 500:
            $msg = "Internal Server Error";
            break;
        case 501:
            $msg = "Not Implemented";
            break;
        case 502:
            $msg = "Bad Gateway";
            break;
        case 503:
            $msg = "Service Unavailable";
            break;
        case 504:
            $msg = "Gateway Timeout";
            break;
        case 505:
            $msg = "HTTP Version not supported";
            break;
        case 506:
            $msg = "Variant Also Negotiates";
            break;
        case 507:
            $msg = "Insufficient Storage";
            break;
        case 508:
            $msg = "Loop Detected";
            break;
        case 509:
            $msg = "Bandwidth Limit Exceeded";
            break;
        case 510:
            $msg = "Not Extended";
            break;
        case 511:
            $msg = "Network Authentication Required";
            break;
    }
    return $msg;
}


?>
