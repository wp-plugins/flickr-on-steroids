<?php

header('Content-Type: text/xml');

$appKey = "&api_key=1b1a0056dcfcb218506cfbe83e6a00e9";
$flickrPrefix = "http://api.flickr.com/services/rest/?method=";

$url1 = $flickrPrefix . "flickr.photosets.getList" . $appKey . "&user_id=" . $_GET["user_id"];;

$fp = fopen($url1, 'r');
fpassthru($fp);

?>
