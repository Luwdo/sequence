<?php
/**
 * Description of autoloader
 *
 * @author luwdo
 */
class SequenceAutoloader {
	public function __construct() {
		$this->install();
	}
	
	public function load($className){
		$configPath = __DIR__.'/SequenceConfig.php';	
		if (is_readable($configPath)) {
			require_once $configPath;
		}
		else{
			throw new Exception('Sequence configuation failed to load.');
		}
		$filename = $className . ".php";
		$filename = str_replace('\\', '/', $filename);
		if (is_readable($filename)) {
			 require_once __DIR__.'/classes/'.$filename.'.php';
		}
    }
	
	public function install(){
		spl_autoload_register(array($this, 'load'));
	}
	
	public function uninstall(){
		spl_autoload_unregister(array($this, 'load'));
	}
}
