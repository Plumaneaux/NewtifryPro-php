<?php
/**
 * NewtifryPro - PHP message push script.
 * for version up to 1.2.0
 */

function iso8601() {
	date_default_timezone_set("UTC");
	$time=time();
	return date("Y-m-d", $time) . 'T' . date("H:i:s", $time) .'.00:00';
}
	
function newtifryProPush(	$apikey,
													$deviceIds,  
													$title, 
													$source = NULL, 
													$message = NULL, 
													$priority = 0, 
													$url = NULL, 
													$imageUrl = NULL, 
													$speak = -1, 
													$noCache = false, 
													$state = 0, 
													$notify = -1) {
	$data = getData($title, $source, $message, $priority, $url, $imageUrl, $speak, $noCache, $state, $notify);

	$fields = array(  'registration_ids'  => $deviceIds,
										'data'              => $data);
	if ($priority == 3) {
		//$fields['priority'] = "high";
	}
	$toSend = json_encode( $data );
	$totalLength = strlen($toSend);
	if ($totalLength > 2000) {
		$maxSize = 1500;
		$partCount = ceil($totalLength / $maxSize);     
		$hash = hash("md5", $toSend);  
		$part = 0;
		while ($totalLength > 0) {
			//print_r($totalLength);
			$countToSend = ($totalLength >= $maxSize) ? $maxSize :  $totalLength;
			$splitData = array (  "type" => "ntp_message_multi",
														"partcount" => $partCount,
														"hash" => $hash,
														"index" => $part + 1,
														"body" => substr($toSend, $part * $maxSize, $countToSend )
													);
			$fields["data"] = $splitData;
			$ret = newtifryProSend($apikey, $fields); 
			print_r($ret);
			$totalLength -= $countToSend;                                                                                                                                                                                    
			$part++;                                                                                                                                                                                                    
		}
	} else {
		$ret = newtifryProSend($apikey, $fields);
	}
	//echo $ret;
	//Return push response as array
	return $ret;
}


function newtifryProPushToTopic(	$apikey,
													$topic,  
													$title, 
													$source = NULL, 
													$message = NULL, 
													$priority = 0, 
													$url = NULL, 
													$imageUrl = NULL, 
													$speak = -1, 
													$noCache = false, 
													$state = 0, 
													$notify = -1) {
	$data = getData($title, $source, $message, $priority, $url, $imageUrl, $speak, $noCache, $state, $notify);

	$fields = array(  'to'  => "/topics/" . $topic,
										'data'              => $data);
	if ($priority == 3) {
		//$fields['priority'] = "high";
	}

	$toSend = json_encode( $data );
	$totalLength = strlen($toSend);
	if ($totalLength > 2000) {
		$maxSize = 1500;
		$partCount = ceil($totalLength / $maxSize);     
		$hash = hash("md5", $toSend);  
		$part = 0;
		while ($totalLength > 0) {
			//print_r($totalLength);
			$countToSend = ($totalLength >= $maxSize) ? $maxSize :  $totalLength;
			$splitData = array (  "type" => "ntp_message_multi",
														"partcount" => $partCount,
														"hash" => $hash,
														"index" => $part + 1,
														"body" => substr($toSend, $part * $maxSize, $countToSend )
													);
			$fields["data"] = $splitData;
			$ret = newtifryProSend($apikey, $fields); 
			print_r($ret);
			$totalLength -= $countToSend;                                                                                                                                                                                    
			$part++;                                                                                                                                                                                                    
		}
	} else {
		$ret = newtifryProSend($apikey, $fields);
	}
	//Return push response as array
	return $ret;
}

function newtifryProSend(	$apikey, $fields) {
	$FCM_URL = "https://fcm.googleapis.com/fcm/send";
	$headers = array( 'Authorization: key=' . $apikey,
										'Content-Type: application/json');
	//var_dump($fields);
	// Open connection
	$ch = curl_init();
	// Set the url, number of POST vars, POST data
	curl_setopt( $ch, CURLOPT_URL, $FCM_URL );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

	// Execute post
	$result = curl_exec($ch);
	// Close connection
	curl_close($ch);
	return json_decode($result, true);
}


function getData( $title, 
									$source, 
									$message, 
									$priority, 
									$url, 
									$imageUrl, 
									$speak, 
									$noCache, 
									$state, 
									$notify) {
	$data = array ( "type" => "ntp_message",
									"timestamp" => iso8601(),
									"priority" => $priority, 
									"title" => base64_encode($title));

	if ($message) {
		$data["message"] = base64_encode($message);
	}
	if ($source) {
		$data["source"] = base64_encode($source);
	}
	if ($url) {
		$data["url"] = base64_encode($url);
	}
	if ($imageUrl) {
		if (is_array($imageUrl)) {
			for ($i = 1; $i < 6; $i++) {
				if ($imageUrl[$i - 1] != null) {
					$data["image" . $i] = base64_encode($imageUrl[$i - 1]);
				}
			}
		} else {
			$data["image"] = base64_encode($imageUrl);
		}
	}

	if ($speak == 0 || $speak == 1) {
		$data["speak"] = $speak;
	}
	if ($noCache == true) {
		$data["nocache"] = 1;
	}
	if ($state == 1 || $state == 2) {
		$data["state"] = $state;
	}
	if ($notify == 0 || $notify == 1) {
		$data["notify"] = $notify;
	}      
	
	return $data;
}
									
?>
