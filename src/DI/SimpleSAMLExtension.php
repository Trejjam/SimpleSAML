<?php

namespace Trejjam\SimpleSAML\DI;

use Trejjam;

class SimpleSAMLExtension extends Trejjam\BaseExtension\DI\BaseExtension
{
	protected $default = [
		'configurationDir'  => '%appDir%/config/simpleSAML/config',
		'configurationFile' => 'config.php',
		'authsourcesFile'   => 'authsources.php', //unused
	];

	protected $classesDefinition = [
		'configure' => 'Trejjam\SimpleSAML\Bridges\Configure',
	];

	public function beforeCompile()
	{
		parent::beforeCompile();

		$config = $this->createConfig();

		$classes = $this->getClasses();
		$classes['configure']->setArguments(
			[
				$config['configurationDir'],
			]
		);
		$classes['configure']->addTag('run');

		$this->createDirectories($config);
	}

	private function createDirectories(array $extensionConfig)
	{
		$config = [];
		include($extensionConfig['configurationDir'] . DIRECTORY_SEPARATOR . $extensionConfig['configurationFile']);

		if (array_key_exists('loggingdir', $config)) {
			@mkdir($config['loggingdir'], 0775, TRUE);
		}
		if (array_key_exists('tempdir', $config)) {
			@mkdir($config['tempdir'], 0775, TRUE);
		}
	}
}
