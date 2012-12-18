#!/usr/bin/php
<?

require 'credis/Client.php';
require 'credis/Cluster.php';

$nTimeout	= 0.5;
$sServers   ='10.128.5.28:8000-8007;10.128.5.29:8008-8015;10.128.5.30:8016-8023;10.128.5.31:8024-8031';
$nMaxRetry	= 2;

try {

	$cluster = new Credis_Cluster($sServers, $nTimeout, $nMaxRetry);
	//$cluster->set('key','test data');
	echo $cluster->get('key') . "\n";
	$cluster->close();

} catch (Exception $e) {
	syslog(LOG_NOTICE, $e->getMessage() );
}

?>
