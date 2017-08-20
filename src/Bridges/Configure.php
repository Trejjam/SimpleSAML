<?php

namespace Trejjam\SimpleSAML\Bridges;

use Trejjam;

class Configure
{
	public function __construct($configurationDir) {
		putenv('SIMPLESAMLPHP_CONFIG_DIR=' . $configurationDir);
	}
}
