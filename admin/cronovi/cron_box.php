<?php
$fajl = "login";

include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/konfiguracija.php");
include("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/admin/includes.php");
require_once('/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/lgsl/lgsl_class.php');
require("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/phpseclib/SSH2.php");
require_once("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/phpseclib/Crypt/AES.php");


/*------------------------------------------------------------------------------------------------------+
 * BOX MONITORING
/*------------------------------------------------------------------------------------------------------*/
$boxData = array();

if (query_fetch_assoc( "SELECT `boxid` FROM `box` ORDER BY `boxid`" ) != 0)
{
	$boxes = mysql_query( "SELECT `boxid`, `ip`, `login`, `password`, `sshport` FROM `box`" );

	while ($rowsBoxes = mysql_fetch_assoc($boxes))
	{
		$aes = new Crypt_AES();
		$aes->setKeyLength(256);
		$aes->setKey(CRYPT_KEY);

		$ssh = new Net_SSH2($rowsBoxes['ip'], $rowsBoxes['sshport']);
		$sifra = $aes->decrypt($rowsBoxes['password']);

		if (!$ssh->login($rowsBoxes['login'], $sifra))
		{
			echo 'Ne mogu se konektovati na masinu ( IP: '.$rowsBoxes['ip'].' )<br />';
			$boxCache =	array(
				$rowsBoxes['boxid'] => array(
					'players'	=> array('players' => 0),

					'bandwidth'	=> array('rx_usage' => 0,
										 'tx_usage' => 0,
										 'rx_total' => 0,
										 'tx_total' => 0),

					'cpu'		=> array('proc' => '',
										 'cores' => 0,
										 'usage' => 0),

					'ram'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0),

					'loadavg'	=> array('loadavg' => '0.00'),
					'hostname'	=> array('hostname' => ''),
					'os'		=> array('os' => ''),
					'date'		=> array('date' => ''),
					'kernel'	=> array('kernel' => ''),
					'arch'		=> array('arch' => ''),
					'uptime'	=> array('uptime' => ''),

					'swap'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0),

					'hdd'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0)
				)
			);

			mysql_query( "UPDATE `box` SET
				`cache` = '".mysql_real_escape_string(gzcompress(serialize($boxCache), 2))."' WHERE `boxid` = '".$rowsBoxes['boxid']."'" );

			unset($boxCache);
		}
		else
		{

			//------------------------------------------------------------------------------------------------------------+
			//We have to clean screenlog.0 files
/*
			$servers = mysql_query( "SELECT `homedir` FROM `server` WHERE `boxid` = '".$rowsBoxes['boxid']."' && `status` = 'Active'" );

			while ($rowsServers = mysql_fetch_assoc($servers))
			{
				$screenlogExists = trim($ssh->exec('cd '.$rowsServers['homedir'].'; test -f screenlog.0 && echo "true" || echo "false";'."\n"));

				if ( $screenlogExists == 'true' )
				{
					$ssh->exec('cd '.$rowsServers['homedir'].'; tail -n 500 screenlog.0 > tmp; cat tmp > screenlog.0; rm tmp;'."\n");
				}

				unset($screenlogExists);
			}
			unset($servers);*/

			//------------------------------------------------------------------------------------------------------------+
			//Retrieves information from box

			// NETWORK INTERFACE
			
			$iface = trim($ssh->exec("netstat -r | grep default | awk '{print $8}'"));

			if ( !preg_match("#^eth[0-9]#", $iface) ) {
				$iface = 'eth0'; //Default value
			}
			
			$iface = 'eth0'; //Default value

			// BANDWIDTH
			$bandwidth_rx_total = intval(trim($ssh->exec('cat /sys/class/net/'.$iface.'/statistics/rx_bytes')));
			$bandwidth_tx_total = intval(trim($ssh->exec('cat /sys/class/net/'.$iface.'/statistics/tx_bytes')));

			// BANDWIDTH USAGE CALCULATION
			$previousBoxCache = mysql_num_rows(mysql_query( "SELECT `cache` FROM `box` WHERE `boxid` = '".$rowsBoxes['boxid']."' LIMIT 1" ));

			if (!empty($previousBoxCache['cache'])) {
				$oldCache = unserialize(gzuncompress($previousBoxCache['cache']));

				$bandwidth_rx_usage = round(( $bandwidth_rx_total - $oldCache["{$rowsBoxes['boxid']}"]['bandwidth']['rx_total'] ) / ( CRONDELAY ), 2);
				$bandwidth_tx_usage = round(( $bandwidth_tx_total - $oldCache["{$rowsBoxes['boxid']}"]['bandwidth']['tx_total'] ) / ( CRONDELAY ), 2);

				// Hot fix in case of the following actions:
				// "stats have been reset"
				// "the box has been rebooted"
				if ( ($bandwidth_rx_usage < 0) || ($bandwidth_tx_usage < 0) ) {
					$bandwidth_rx_usage = 0;
					$bandwidth_tx_usage = 0;
				}
			}

			// No data
			if ( !isset($bandwidth_rx_usage) || !isset($bandwidth_tx_usage) ) {
				$bandwidth_rx_usage = 0;
				$bandwidth_tx_usage = 0;
			}

			unset($iface, $previousBoxCache, $oldCache);
			//---------------------------------------------------------+

			// CPU INFO
			$cpu_proc = trim($ssh->exec("cat /proc/cpuinfo | grep 'model name' | awk -F \":\" '{print $2}' | head -n 1"));
			$cpu_cores = intval(trim($ssh->exec("nproc")));

			// CPU USAGE
			$cpu_usage = intval(trim($ssh->exec("ps -A -u ".$rowsBoxes['login']." -o pcpu | tail -n +2 | awk '{ usage += $1 } END { print usage }'")));
			$cpu_usage = round(($cpu_usage / $cpu_cores), 2);

			//---------------------------------------------------------+

			// MEMORY INFO
			$ram_used = intval(trim($ssh->exec("free -b | grep 'buffers/cache' | awk -F \":\" '{print $2}' | awk '{print $1}'")));
			$ram_free = intval(trim($ssh->exec("free -b | grep 'buffers/cache' | awk -F \":\" '{print $2}' | awk '{print $2}'")));
			$ram_total = $ram_used + $ram_free;
			$ram_usage = round((($ram_used / $ram_total) * 100), 2);

			//---------------------------------------------------------+

			// LOAD AVERAGE
			$loadavg = trim($ssh->exec("top -b -n 1 | grep 'load average' | awk -F \",\" '{print $5}'"));

			//---------------------------------------------------------+

			// MISC INFO
			$hostname = trim($ssh->exec('hostname'));
			$os = trim($ssh->exec('uname -o'));
			$date = trim($ssh->exec('date'));
			$kernel = trim($ssh->exec('uname -r'));
			$arch = trim($ssh->exec('uname -m'));

			//---------------------------------------------------------+
			
			// UPTIME
			$uptime = intval(trim($ssh->exec("cat /proc/uptime | awk '{print $1}'")));

			$uptimeMin = $uptime / 60;
			if ($uptimeMin > 59) {
				$uptimeH = $uptimeMin / 60;
				if ($uptimeH > 23) {
					$uptimeD = $uptimeH / 24;
				}
				else {
					$uptimeD = 0;
				}
			}
			else {
				$uptimeH = 0;
				$uptimeD = 0;
			}
			$uptime = floor($uptimeD).' days '.($uptimeH % 24).' hours '.($uptimeMin % 60).' minutes ';

			unset($uptimeMin, $uptimeH, $uptimeD);

			//---------------------------------------------------------+

			// SWAP INFO
			$swap_used = intval(trim($ssh->exec("free -b | grep 'Swap' | awk -F \":\" '{print $2}' | awk '{print $2}'")));
			$swap_free = intval(trim($ssh->exec("free -b | grep 'Swap' | awk -F \":\" '{print $2}' | awk '{print $3}'")));
			$swap_total = $swap_used + $swap_free;
			$swap_usage = round((($swap_used / $swap_total) * 100), 2);

			//---------------------------------------------------------+
			
			// HARD DISK DRIVE INFO
			$hdd_total = (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $2}'"))) * 1024);
			$hdd_used = (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $3}'"))) * 1024);
			$hdd_free = (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $4}'"))) * 1024);
			$hdd_usage = intval(substr(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $5}'")), 0, -1));

			//------------------------------------------------------------------------------------------------------------+
			//Retrieves num players of the box

			$p = 0;

			$servers = mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '".$rowsBoxes['boxid']."'");

			while ($rowsServers = mysql_fetch_array($servers))
			{
				$serverIp = query_fetch_assoc( "SELECT * FROM `boxip` WHERE `ipid` = '".$rowsServers['ip_id']."' LIMIT 1" );

				if ($rowsServers['status'] == 'Aktivan' && $rowsServers['startovan'] == '1')
				{
					if($rowsServers['igra'] == "1") $igra = "cs";
					else if($rowsServers['igra'] == "2") $igra = "samp";
					else if($rowsServers['igra'] == "3") $igra = "minecraft";
					
					require_once("/var/zpanel/hostdata/zadmin/public_html/insomnia-community_info/includes/libs/lgsl/lgsl_class.php");	
					
					
					if($rowsServers['igra'] == "1") $querytype = "halflife";
					else if($rowsServers['igra'] == "2") $querytype = "samp";
					else if($rowsServers['igra'] == "4") $querytype = "callofduty4";
					else if($rowsServers['igra'] == "3") $querytype = "minecraft";
					else if($rowsServers['igra'] == "5") $querytype = "mta";
							

					if($rowsServers['igra'] == "5") $serverl = lgsl_query_live($querytype, $serverIp['ip'], NULL, $rowsServers['port']+123, NULL, 's');
					else $serverl = lgsl_query_live($querytype, $serverIp['ip'], NULL, $rowsServers['port'], NULL, 's');	

					
					$p = $p + @$serverl['s']['players'];
				}

				unset($serverIp);
			}
			unset($servers);

			//------------------------------------------------------------------------------------------------------------+
			//Data

			$boxCache =	array(
				$rowsBoxes['boxid'] => array(
					'players'	=> array('players' => $p),

					'bandwidth'	=> array('rx_usage' => $bandwidth_rx_usage,
										 'tx_usage' => $bandwidth_tx_usage,
										 'rx_total' => $bandwidth_rx_total,
										 'tx_total' => $bandwidth_tx_total),

					'cpu'		=> array('proc' => $cpu_proc,
										 'cores' => $cpu_cores,
										 'usage' => $cpu_usage),

					'ram'		=> array('total' => $ram_total,
										 'used' => $ram_used,
										 'free' => $ram_free,
										 'usage' => $ram_usage),

					'loadavg'	=> array('loadavg' => $loadavg),
					'hostname'	=> array('hostname' => $hostname),
					'os'		=> array('os' => $os),
					'date'		=> array('date' => $date),
					'kernel'	=> array('kernel' => $kernel),
					'arch'		=> array('arch' => $arch),
					'uptime'	=> array('uptime' => $uptime),

					'swap'		=> array('total' => $swap_total,
										 'used' => $swap_used,
										 'free' => $swap_free,
										 'usage' => $swap_usage),

					'hdd'		=> array('total' => $hdd_total,
										 'used' => $hdd_used,
										 'free' => $hdd_free,
										 'usage' => $hdd_usage)
				)
			);

			unset($p, $bandwidth_rx_total, $bandwidth_tx_total, $bandwidth_rx_usage, $bandwidth_tx_usage, $cpu_proc, $cpu_cores, $cpu_usage);
			unset($ram_used, $ram_free, $ram_total, $ram_usage, $loadavg, $hostname, $os, $date, $kernel, $arch, $uptime);
			unset($swap_used, $swap_free, $swap_total, $swap_usage, $hdd_total, $hdd_used, $hdd_free, $hdd_usage);

			//------------------------------------------------------------------------------------------------------------+
			//Update DB for the current box

			mysql_query( "UPDATE `box` SET
				`cache` = '".mysql_real_escape_string(gzcompress(serialize($boxCache), 2))."' WHERE `boxid` = '".$rowsBoxes['boxid']."'" );

			$boxData = $boxData + $boxCache;

			unset($boxCache);
		}

		usleep(20000);

		$ssh->disconnect();
	}
	unset($boxes);
	unset($boxData);
}
mysql_query( "UPDATE `config` SET `value` = '".date('Y-m-d H:i:s')."' WHERE `setting` = 'lastcronboxrun'" );
?>