<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 31.8.15
 * Time: 15:06
 */

namespace Trejjam\SimpleSAML\Bridges;


use Nette,
	Trejjam;

class Configure
{
	public function __construct($configurationDir) {
		putenv('SIMPLESAMLPHP_CONFIG_DIR=' . $configurationDir);
	}
}
