<?php
namespace App\Http\Controllers\bceApi;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\bceApi\BceAuthController;
use App\Http\Controllers\Controller;
class BceRController extends Controller
{


public  function generateAuthorization($ak, $sk, $method, $host, $uri, $params, $timestamp, $expirationInSeconds) {
      $timeStr = $timestamp->format("Y-m-d\TH:i:s\Z");
      $authStringPrefix = "bce-auth-v1/{$ak}/{$timeStr}/{$expirationInSeconds}";
      $signingKey = hash_hmac('SHA256', $authStringPrefix, $sk);
      $canonicalHeader1 = "host;x-bce-date";
      $canonicalHeader2 = "host:{$host}\n" . "x-bce-date:" . urlencode($timeStr);
      $BceAuthController = new BceAuthController();
      $canonicalString = $BceAuthController->getCanonicalQueryString($params);
      $canonicalUri = $BceAuthController->getCanonicalURIPath($uri);
      $method = strtoupper($method);
      $canonicalRequest = "{$method}\n{$canonicalUri}\n{$canonicalString}\n{$canonicalHeader2}";
      $signature = hash_hmac('SHA256', $canonicalRequest, $signingKey);
      $authorization = "bce-auth-v1/{$ak}/{$timeStr}/{$expirationInSeconds}/{$canonicalHeader1}/{$signature}";
      return $authorization;
  }
  public function show()
  {
  
  // 第一步：生成认证字符串
  $ak = "32a53eb48a3a4780aa420b09187ed54f";  // AccessKeyId
  $sk = "93f2924adff94228b45ece581eeaa27f";  // SecretAccessKey

  $method = "GET";
  $host = "iotdm.gz.baidubce.com";
  $uri = "/v3/iot/management/deviceView/lock123";
   ///v3/iot/management/deviceView/myDevice?updateView

  $params = array();

  date_default_timezone_set('PRC');
  $timestamp = new \DateTime();
  $expirationInSeconds = 60;
  $authorization = $this->generateAuthorization($ak, $sk, $method, $host, $uri, $params, $timestamp, $expirationInSeconds);

  // 第二步：构造HTTP请求的header、body等信息
  $url = "http://{$host}{$uri}";
  print($url)."\n";
  $timeStr = $timestamp->format("Y-m-d\TH:i:s\Z");
  $head =  array(
     "Content-Type: application/json",
      "Authorization:{$authorization}",
      "x-bce-date:{$timeStr}",
  );
  $body = array(
  	//'gdffff'
      //'piplineName' => 'zzypipline'
      // 'username'=>'devicelock/endpoint',
      // 'password'=>'22JaaYoojWMFLSo5KMBlgTsGfrTXVwE5uM2gztgVSSU='
       // "deviceName"=> "mydevice",
       //   "description"=> "device_description",
       //   "schemaId"=>"_baidu_sample_pump"

      //  "name"=> "1234939554",

      // "description"=>"new description",

      // "type"=>"NORMAL"
      // "addedDevices"=> array(
      //     "lock"


      // )

     // "desired"=> array(
     //      "power"=> "40"
     //  ),
     //  "reported"=> array(
     //      "power"=> "60"
     //  )





  );

  $bodyStr = json_encode($body);

  // 第三步：发送HTTP请求，并输出响应信息。
  $curlp = curl_init();
  //curl_setopt($curlp, CURLOPT_POST, 1);
  curl_setopt($curlp, CURLOPT_URL, $url);
  curl_setopt($curlp, CURLOPT_HTTPHEADER, $head);
  curl_setopt($curlp, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($curlp, CURLOPT_POSTFIELDS, $bodyStr);
  curl_setopt($curlp, CURLINFO_HEADER_OUT, 1);
  curl_setopt($curlp, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($curlp);
  $request = curl_getinfo($curlp, CURLINFO_HEADER_OUT);
  $status = curl_getinfo($curlp, CURLINFO_HTTP_CODE);
  curl_close($curlp);
  print("request: {$request}\n");
  print("request body: {$bodyStr}\n");
  print("status: {$status}\n");
  print("response: {$response}\n");



  }
}
