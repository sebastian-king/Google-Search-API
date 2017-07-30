<?php

if (file_exists("config.php")) {
	include("config.php");
}
require("dom.php");

function search($query, $timeout = 5, $site_domain = SITE) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?hl=en&output=search&q=site%3A" . $site_domain . "+" . urlencode($query));
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.21 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_HEADER, true);
	$result = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	if ($httpcode == 503) { // we have been provided a captcha verification by Google
		return false;
	}
	
	$html = str_get_html($result);

	$results = array();
	$i = 0;
	foreach($html->find('div[class=g]') as $element) {
		$_title = current($element->find('h3[class=r] > a'));
		$_url = $_title->getAttribute("href");
		$_description = current($element->find('span[class=st]'))->innertext;
		$_type_e = $element->find('h3[class=r] > span');
		if (count($_type_e)) {
			$_type = preg_replace("/^\[(.+)\]$/", "$1", trim(current($_type_e)->plaintext));
		} else {
			$_type = false;
		}
		$results[$i]["title"] = $_title->plaintext;
		$results[$i]["url"] = $_url;
		$results[$i]["description"] = $_description;
		$results[$i]["type"] = $_type;
		$i++;
	}
	return $results;
}