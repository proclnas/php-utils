<?php

namespace Util;

class Network {
	/**
	 * Generate ip range
	 * @param  string $ipA [description]
	 * @param  string $ipB [description]
	 * @return \Generator
	 */
	public static function genIp($ipA, $ipB) {
		$ipA = ip2long($ipA);
		$ipB = ip2long($ipB);

		while ($ipA <= $ipB) {
			yield long2ip($ipA++);
		}
	}
}