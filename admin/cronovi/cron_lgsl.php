<?php
$fajl = "login";

include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/konfiguracija.php");
include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/admin/includes.php");
require_once('/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/lgsl/lgsl_class.php');
require("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/phpseclib/SSH2.php");
require_once("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/phpseclib/Crypt/AES.php");


/*------------------------------------------------------------------------------------------------------+
 * DOBIJANJE PODATAKA ZA SERVERE ( LGSL )
/*------------------------------------------------------------------------------------------------------*/
lgsl_database();

// SETTINGS:

$lgsl_config['cache_time'] = 30; // HOW OLD CACHE MUST BE BEFORE IT NEEDS REFRESHING
$request = "sep";                // WHAT TO PRE-CACHE: [s] = BASIC INFO [e] = SETTINGS [p] = PLAYERS

//------------------------------------------------------------------------------------------------------------+

$mysql_query  = "SELECT `type`,`ip`,`c_port`,`q_port`,`s_port` FROM `lgsl` WHERE `disabled`=0 ORDER BY `cache_time` ASC";
$mysql_result = mysql_query($mysql_query) or die(mysql_error());

while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
{
	lgsl_query_cached($mysql_row['type'], $mysql_row['ip'], $mysql_row['c_port'], $mysql_row['q_port'], $mysql_row['s_port'], $request);
}

mysql_query( "UPDATE `config` SET `value` = '".date('Y-m-d H:i:s')."' WHERE `setting` = 'lastcronlgslrun'" );