<?php
/**
 * Description of BaseConfig
 *
 * @author luwdo
 */
class SequenceConfig {
	protected $dbHost = ''; //servername
	protected $dbName = ''; //database name
	protected $dbUsername = '';
	protected $dbPassword = '';
	
	private static $config = null;
	
	public function __construct() {
		self::setConfig($this);
	}
	
	/**
	 * Returns a new configution object
	 * @return \Config
	 */
	public static function create(){
		return new Config();
	}
	
	/**
	 * set the configuration object only
	 * @param type $object
	 */
	protected static function setConfig($object){
		if(!($object instanceof Config)){
			throw new Exception('$object can only be a object derived from Config.');
		}
		
		self::$config = $object;
	}
	
	public static function getConfig(){
		if(!self::$config){
			throw new Exception('Missing Configuration Instance');
		}
		return self::$config;
	}
	
	/**
	 * 
	 * @param type $dbHost
	 * @return \Config
	 */
	public function setDbHost($dbHost) {
		$this->dbHost = $dbHost;
		return $this;
	}
	
	/**
	 * 
	 * @param type $dbName
	 * @return \Config
	 */
	public function setDbName($dbName) {
		$this->dbName = $dbName;
		return $this;
	}
	
	/**
	 * 
	 * @param type $hostUsername
	 * @return \Config
	 */
	public function setDbUsername($hostUsername) {
		$this->dbUsername = $hostUsername;
		return $this;
	}
	
	/**
	 * 
	 * @param type $dbPassword
	 * @return \Config
	 */
	public function setDbPassword($dbPassword) {
		$this->dbPassword = $dbPassword;
		return $this;
	}
	
	
	public function getDbHost() {
		return $this->dbHost;
	}
	
	public function getDbName() {
		return $this->dbName;
	}
	
	public function getDbUsername() {
		return $this->dbUsername;
	}
	
	public function getDbPassword() {
		return $this->dbPassword;
	}
}
