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
							"Test message 1", 
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
							"Test message 2", 
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
							"Test message 3", 
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

// with 5 images
$images = array(
    "http://www.newtifry.org/test_newtifry1.jpg",
    "http://www.newtifry.org/test_newtifry2.png",
    "http://www.newtifry.org/test_newtifry3.jpg",
    "http://www.newtifry.org/test_newtifry4.jpg",
    "http://www.newtifry.org/test_newtifry5.jpg");
$result = newtifryProPush(  $apikey,
							$deviceIds, 
							"Test message 4", 
							"locked 5 images", 
							"Hello from NewtifryPro", 
							1, 
							"https://newtifry.appspot.com", 
							$images, 
							-1,	// speak 
							false, 	// noCache
							2, 	// state : locked
							-1); 	// notify
    
?>
