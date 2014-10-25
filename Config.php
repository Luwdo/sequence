<?php
/**
 * Description of BaseConfig
 *
 * @author luwdo
 */
class Config {
	protected static $dbHost = ''; //servername
	protected static $dbName = ''; //database name
	protected static $dbUsername = '';
	protected static $dbPassword = '';
	
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
		self::$dbHost = $dbHost;
		return $this;
	}
	
	/**
	 * 
	 * @param type $dbName
	 * @return \Config
	 */
	public function setDbName($dbName) {
		self::$dbName = $dbName;
		return $this;
	}
	
	/**
	 * 
	 * @param type $hostUsername
	 * @return \Config
	 */
	public function setDbUsername($hostUsername) {
		self::$dbUsername = $hostUsername;
		return $this;
	}
	
	/**
	 * 
	 * @param type $dbPassword
	 * @return \Config
	 */
	public function setDbPassword($dbPassword) {
		self::$dbPassword = $dbPassword;
		return $this;
	}
	
	
	public function getDbHost() {
		return self::$dbHost;
	}
	
	public function getDbName() {
		return self::$dbName;
	}
	
	public function getDbUsername() {
		return self::$dbUsername;
	}
	
	public function getDbPassword() {
		return self::$dbPassword;
	}
}
