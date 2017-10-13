<?php

require __DIR__ . '/../Network.php';

use Util\Network;

foreach (Network::genIp('192.168.0.1', '192.168.1.255') as $ip) {
	echo $ip . PHP_EOL;
}