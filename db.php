<?php

class db extends mysqli{
    static $instance = null;
    
    private static $host = '';
    private static $user = '';
    private static $password = '';
    private static $database = '';

    public function __construct($args = array()) {
       parent::__construct(self::$host, self::$user, self::$password, self::$database);

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