<?php
$fajl = "login";

include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/konfiguracija.php");
include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/admin/includes.php");
require_once('/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/lgsl/lgsl_class.php');

error_reporting(E_ALL);

$serveri = mysql_query("SELECT * FROM `serveri`");

echo query_numrows("SELECT * FROM `serveri`")." servera<br />";

while($row = mysql_fetch_assoc($serveri))
{
	$mod = query_fetch_assoc("SELECT `cena` FROM `modovi` WHERE `id` = '{$row['mod']}' LIMIT 1");
	$mod = explode("|", $mod['cena']);
	$cena = ($mod[1] * $row['slotovi']);
	query_basic("UPDATE `serveri` SET `cena` = '{$cena}' WHERE `id` = '{$row['id']}'");
	echo $row['name']." - {$cena} | ".novac($cena, 'bih')."<br />";
}
?>
