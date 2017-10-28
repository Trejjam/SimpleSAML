<?php
declare(strict_types=1);

namespace Trejjam\SimpleSAML\DI;

use Trejjam;

class SimpleSAMLExtension extends Trejjam\BaseExtension\DI\BaseExtension
{
	protected $default = [
		'configurationDir'  => 'config/simpleSAML/config',
		'configurationFile' => 'config.php',
		'authsourcesFile'   => 'authsources.php', //unused
	];

	protected $classesDefinition = [
		'configure' => 'Trejjam\SimpleSAML\Bridges\Configure',
	];

	public function loadConfiguration(bool $validateConfig = TRUE) : void
	{
		$this->default['configurationDir'] = $this->getContainerBuilder()->parameters['appDir'] . DIRECTORY_SEPARATOR . $this->default['configurationDir'];

		parent::loadConfiguration($validateConfig);
	}

	public function beforeCompile()
	{
		parent::beforeCompile();

		$types = $this->getTypes();
		$types['configure']->setArguments(
			[
				$this->config['configurationDir'],
			]
		);
		$types['configure']->addTag('run');

		$this->createDirectories($this->config);
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
