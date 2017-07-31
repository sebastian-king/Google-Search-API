<?php
require("api.php");
@include("optional/cse-api/api.php");

echo "<pre>";

$results = search($_GET['query']);

echo "PRIMARY:<br>";
foreach ($results as $key => $val) {
        echo "<div>" . ($val['type'] ? "({$val['type']}) " : "") . "<a href='{$val['url']}'>{$val['title']}</a><p>{$val['description']}</p></div>" . PHP_EOL;
}

if (defined('GOOGLE_API_KEY') && defined('GOOGLE_CSE_ID') && GOOGLE_API_KEY &&GOOGLE_CSE_ID) {
	echo "BACKUP:<br>";
	$results = cse_search($_GET['query']);
	foreach ($results as $key => $val) {
        echo "<div>" . ($val['type'] ? "({$val['type']}) " : "") . "<a href='{$val['url']}'>{$val['title']}</a><p>{$val['description']}</p></div>" . PHP_EOL;
	}
}