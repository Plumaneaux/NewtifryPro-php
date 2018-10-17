<?php
// how to use :
// install withWebServer.php and NewtifryPro.php on a web server
// call http://YOUWEBSERVERPATH/send2NP.php?apiKey=APIKEY&deviceID=DEVICEID&source=The+Source&title=The+Title&message=The+Message&priority=1 etc...

// https://www.thunderace.fr/NewtifryPro-php/send2NP.php?apiKey=AIzaSyBWOvdmm9gXfWzm7SqVQR2A3D4GVwqnVGk&deviceID=dkZJ3pRbFG8:APA91bH-6d0siLYSj-PmwtosO6L0vB3HkwN-wUP_cdw-mwIklRYMFG0_E-hYrB_S_jBuzsr2HDqbTy_0v5Gp6OT4mavZnhJuRY025Gsm6R963WjgECfwsnXbLIIHj-ifOq0dW4GJjVgX&source=The+Source&title=The+Title&message=The+Message&priority=1
include ("NewtifryPro.php");

$deviceIds = array();
// get params from url
$deviceId= isset($_GET["deviceID"]) ? $_GET["deviceID"] : NULL;
$apikey = isset($_GET["apiKey"]) ? $_GET["apiKey"] : NULL;
$source = isset($_GET["source"]) ? $_GET["source"] : NULL;
$title = isset($_GET["title"]) ? $_GET["title"] : NULL;
$message = isset($_GET["message"]) ? $_GET["message"] : NULL;
$priority = isset($_GET["priority"]) ? $_GET["priority"] : 0;
$url = isset($_GET["url"]) ? $_GET["url"] : NULL;
$image = isset($_GET["image"]) ? $_GET["image"] : NULL;
$speak = isset($_GET["speak"]) ? $_GET["speak"] : -1;
$noCache = isset($_GET["noCache"]) ? $_GET["noCache"] : false;
$state = isset($_GET["state"]) ? $_GET["state"] : 0;
$notify = isset($_GET["notify"]) ? $_GET["notify"] : -1;
$tag = isset($_GET["notify"]) ? $_GET["notify"] : NULL;

if ($deviceId == NULL) {
  echo("KO : deviceID is mandatory");
  return;
}
$deviceIds[] = $deviceId;
if ($apikey == NULL) {
  echo("KO : apikey is mandatory");
  return;
}
if ($title == NULL) {
  echo("KO : Title is mandatory");
  return;
}

$result = newtifryProPush(  $apikey,
                            $deviceIds, 
                            $title, 
                            $source, 
                            $message, 
                            $priority, 
                            $url, 
                            $image, 
                            $speak,	
                            $noCache, 
                            $state, 
                            $notify,
                            $tag);
                            
print_r($result);
$success = $result['success'];
if ($success == 1) {
  echo("OK");
} else {
  echo("KO");
}
?>