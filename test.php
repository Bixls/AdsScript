<?php
header('Content-Type: text/html; charset=utf-8');
require_once ("AdsScript.php");
require_once ("simple_html_dom.php");
$Ads = new AdsScript();
$title = $Ads->getTitle();
$img = $Ads->getImg();
?>
<h1><?php echo $title;?></h1>
<img src="<?php echo $img; ?>">