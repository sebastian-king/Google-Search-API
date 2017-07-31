<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . "/../../config.php");

function cse_search($query, $GOOGLE_CSE_ID = GOOGLE_CSE_ID, $GOOGLE_API_KEY = GOOGLE_API_KEY) {

	$client = new Google_Client();
	$client->setApplicationName("AppName");
	$client->setDeveloperKey($GOOGLE_API_KEY);

	try {
	$service = new Google_Service_Customsearch($client);

	$optParams = array("cx"=>$GOOGLE_CSE_ID);
	$result = $service->cse->listCse($query, $optParams);
	} catch (Google_Service_Exception $e) {
		$errors = $e->getErrors();
	}
	if ($errors[0]['reason'] == "dailyLimitExceeded") {
		return false;
	}

	$i = 0;
	$results = array();
	
	foreach ($result->items as $key => $val) {
		$results[$i]["title"] = $val['title'];
		$results[$i]["url"] = $val['formattedUrl'];
		$results[$i]["description"] = trim(str_replace($query, "<em>$query</em>", $val['snippet']));
		$results[$i]["type"] = $val['fileFormat'] ? $val['fileFormat'] : false;
		$i++;
	}
	
	return $results;
}
?>
