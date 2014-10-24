<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of select_query
 *
 * @author luwdo
 */
class select_query extends data_yielding_query{
	public $select = '*'; // if array assming that you are aliasing it?
	
	
	public function generate_query(){
        $this->params = array();
        return 'SELECT '.$this->generate_select().' FROM '.$this->table.$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
    }
	
	
	public function generate_select(){
        if(!is_array($this->select)){
            if($this->result_type == self::COUNT){
                return 'COUNT('.$this->select.')';
            }
            return $this->select;
        }
        
        //aliasing should be done latter all at once
        /*$select_parts = array();
        foreach($this->select as $alias => $column){
            $select_parts[] = $column.' AS '.$alias;
        }
        return implode(', ', $select_parts);*/
    }
	
	
}
