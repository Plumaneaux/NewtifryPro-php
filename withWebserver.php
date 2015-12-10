<?php
// how to use :
// install withWebServer.php and NewtifryPro.php on a web server
// call http://YOUWEBSERVERPATH/withWebserver.php?source=The+Source&title=The+Title&message=The+Message&priority=1 etc...

include ("NewtifryPro.php");

$apikey = "YourGoogleAPIKEY";
$deviceIds = array();
// Add your GCM IDs below
$deviceIds[] = "MyFirstGCMDeviceID";
//$deviceIds[] = "MySecondGCMDeviceIDIfAny";

// get params from url
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

if ($title == NULL) {
  echo("KO");
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
                            $notify);
                            
//print_r(get_object_vars($result));
$success = get_object_vars($result)['success'];
if ($success == 1) {
  echo("OK");
} else {
  echo("KO");
}
?>