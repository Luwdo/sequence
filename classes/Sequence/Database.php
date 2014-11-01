<?php
namespace Sequence;
class Database extends mysqli{
    
    private $host = '';
    private $user = '';
    private $password = '';
    private $database = '';
	
	static $instance = null;

    public function __construct() {
		$sequenceConfig = \SequenceConfig::getConfig();
		$this->host = $sequenceConfig->getDbHost();
		$this->user = $sequenceConfig->getDbUsername();
		$this->password = $sequenceConfig->getDbPassword();
		$this->database = $sequenceConfig->getDbName();

		parent::__construct($this->host, $this->user, $this->password, $this->database);

		if(mysqli_connect_errno()) {
		   throw new exception(mysqli_connect_error(), mysqli_connect_errno()); 
		}

    }
     
    public static function i() {
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }   


}