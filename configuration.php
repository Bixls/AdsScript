<?php
$servername = "localhost";
$username = "justsear_adsuser";
$password = "adsanwer";
$conn = mysql_connect($servername, $username, $password) or die('Could not connect to MySQL server.');
mysql_select_db("justsear_ads");
?>