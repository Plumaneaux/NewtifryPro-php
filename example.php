<?
include ("NewtifryPro.php");

$apikey = "YourGoogleAPIKEY";
$deviceIds = array();
// Add your GCM IDs below
$deviceIds[] = "MyFirstGCMDeviceID";
//$deviceIds[] = "MySecondGCMDeviceIDIfAny";

// samples
// standard message
$result = newtifryProPush(	$apikey,
							$deviceIds, 
							"Test message", 
							"Normal", 
							"Hello from NewtifryPro", 
							1, 
							"https://newtifry.appspot.com", 
							"http://www.newtifry.org/test_newtifry.jpg", 
							-1,	// speak 
							false, 	// noCache
							0, 	// state : default
							-1); 	// notify
print_r($result);
// sticky message
$result = newtifryProPush(	$apikey,
							$deviceIds, 
							"Test message", 
							"Sticky", 
							"Hello from NewtifryPro", 
							1, 
							"https://newtifry.appspot.com", 
							"http://www.newtifry.org/test_newtifry.jpg", 
							-1,	// speak 
							false, 	// noCache
							1, 	// state : sticky
							-1); 	// notify
print_r($result);
// locked message
$result = newtifryProPush(	$apikey,
							$deviceIds, 
							"Test message", 
							"Locked", 
							"Hello from NewtifryPro", 
							1, 
							"https://newtifry.appspot.com", 
							"http://www.newtifry.org/test_newtifry.jpg", 
							-1,	// speak 
							false, 	// noCache
							2, 	// state : locked
							-1); 	// notify
print_r($result);
?>
