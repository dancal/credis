# Credis

Credis is a lightweight interface to the [Redis](http://redis.io/) key-value store which wraps the [phpredis](https://github.com/nicolasff/phpredis)
library when available for better performance. This project was forked from one of the many redisent forks.

## Getting Started

Credis uses methods named the same as Redis commands, and translates return values to the appropriate PHP equivalents.

    require 'Credis/Client.php';
    $redis = new Credis_Client('localhost');
    $redis->set('awesome', 'absolutely');
    echo sprintf('Is Credis awesome? %s.\n', $redis->get('awesome'));

    // When arrays are given as arguments they are flattened automatically
    $redis->rpush('particles', array('proton','electron','neutron'));
    $particles = $redis->lrange('particles', 0, -1);

Redis error responses will be wrapped in a CredisException class and thrown.

## Clustering your servers

Credis also includes a way for developers to fully utilize the scalability of Redis with multiple servers and [consistent hashing](http://en.wikipedia.org/wiki/Consistent_hashing).
Using the Credis_Cluster class, you can use Credis the same way, except that keys will be hashed across multiple servers.
Here is how to set up a cluster:

require 'credis/Client.php';
require 'credis/Cluster.php';

$nTimeout   = 0.5;
$sServers   ='192.168.0.10:8000-8007;192.168.0.11:8008-8015;192.168.0.12:8016-8023;192.168.0.13:8024-8031';
$nMaxRetry  = 2;

try {

    $cluster = new Credis_Cluster($sServers, $nTimeout, $nMaxRetry);
    //$cluster->set('key','test data');
    echo $cluster->get('key') . "\n";
    $cluster->close();

} catch (Exception $e) {
    syslog(LOG_NOTICE, $e->getMessage() );
}

## About

&copy; 2011 [Colin Mollenhour](http://colin.mollenhour.com)
&copy; 2009 [Justin Poliey](http://justinpoliey.com)
