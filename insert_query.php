<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of insert_query
 *
 * @author luwdo
 */
class insert_query extends executable_query{
	public $set = array();
	
	public function generate_query(){
        $this->params = array();
        return 'INSERT INTO '.$this->table.' '.$this->generate_insert();
    }
	
	public function generate_insert(){
        $target = array();
        $values = array();
        foreach($this->set as $k => $v){
            $this->params[] = $v;
            $target[] = $k;
            $values[] = '?';
        }
        
        return '('.implode(', ', $target).') VALUES ('.implode(', ', $values).')';
    }
	
}
