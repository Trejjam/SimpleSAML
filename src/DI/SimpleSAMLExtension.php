<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 26. 10. 2014
 * Time: 17:38
 */

namespace Trejjam\SimpleSAML\DI;

use Nette,
	Trejjam;

class SimpleSAMLExtension extends Trejjam\BaseExtension\DI\BaseExtension
{
	protected $default = [
		'configurationDir' => '%appDir%/config/simpleSAML/config'
	];

	protected $classesDefinition = [
		'configure' => 'Trejjam\SimpleSAML\Bridges\Configure',
	];

	//protected $factoriesDefinition = [
	//'fooFactory' => 'Trejjam\...',
	//];

	public function beforeCompile() {
		parent::beforeCompile();

		$config = $this->createConfig();
		$classes = $this->getClasses();
		$classes['configure']->setArguments([
			$config['configurationDir'],
		]);
		$classes['configure']->addTag('run');
	}
}
