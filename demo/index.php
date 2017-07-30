<?php
require("../api.php");

if (isset($_GET['s']) || isset($_GET['q'])) {
	if (empty($_GET['q'])) {
		echo "You must enter a search query.";
	} elseif (empty($_GET['s'])) {
		echo "You must enter a domain name.";
	} else {
		$results = search($_GET['q'], 5, $_GET['s']);
		var_dump("Results:", $results);
	}
}
?>
<form name="a" action="" method="GET">
	<input name="q" type="search" placeholder="Search"/>
    <input name="s" type="text" placeholder="Site, e.g.: example.com"/>
    <input type="submit" value="Search"/>
</form>