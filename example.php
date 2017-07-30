<?php
require("api.php");

$results = search($_GET['query']);

foreach ($results as $key => $val) {
        echo "<div>" . ($val['type'] ? "({$val['type']}) " : "") . "<a href='{$val['url']}'>{$val['title']}</a><p>{$val['description']}</p></div>" . PHP_EOL;
}