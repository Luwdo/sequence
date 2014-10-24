<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of update_query
 *
 * @author luwdo
 */
class update_query extends filterable_query{
	public $set = array();
	
	public function generate_query(){
        $this->params = array();
        return 'UPDATE '.$this->table.' '.$this->generate_update().$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
    }
	
	public function generate_update(){
        $update = array();
        foreach($this->set as $k => $v){
            $update[] = $k.' = \''.$v.'\'';
        }
        
        return ' SET '.implode(', ', $update);
    }
	
	
}
