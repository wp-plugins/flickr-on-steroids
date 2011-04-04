<?php

header('Content-Type: text/xml');

$appKey = "&api_key=1b1a0056dcfcb218506cfbe83e6a00e9";
$flickrPrefix = "http://api.flickr.com/services/rest/?method=";

$url1 = $flickrPrefix . "flickr.photosets.getPhotos" . $appKey . "&photoset_id=" . $_GET["photoset_id"]. "&per_page=" . $_GET["per_page"] . "&page=" . $_GET["page"];;

$fp = fopen($url1, 'r');
fpassthru($fp);

?>
