<?php

header('Content-Type: text/xml');

//echo "<?xml version=\"1.0\" encoding=\"utf-8\" >\n";

echo "<root>\n";

$appKey = "&api_key=1b1a0056dcfcb218506cfbe83e6a00e9";
$flickrPrefix = "http://api.flickr.com/services/rest/?method=";

for ($i=0; $i<$_POST["num"]; $i++) {
  $url1 = $flickrPrefix . "flickr.photos.getSizes" . $appKey . "&photo_id=" . $_POST["id".$i];
  $txt= file_get_contents($url1);
//  $txt = preg_replace("/&lt;/i", "<", $txt);

  $txt = preg_replace("/<.xml version[^>]+.\n/i", "", $txt);
  $txt = preg_replace("/<rsp[^>]+.\n/i", "", $txt);
  $txt = preg_replace("/<\/rsp>\n/i", "", $txt);

  echo $txt;
}

echo "</root>\n";

?>

