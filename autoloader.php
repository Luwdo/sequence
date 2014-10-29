<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoloader
 *
 * @author luwdo
 */
class Autoloader {
	public static function load($class_name){
		require_once(__DIR__.'/Config.php');
        require_once(__DIR__.'/classes/Sequence/'.$class_name.'.php');
    }
}
