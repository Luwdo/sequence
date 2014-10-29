<?php
namespace Sequence;
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
class UpdateQuery extends FilterableQuery{
	public $set = array();
	
	public function generateQuery(){
        $this->params = array();
        return 'UPDATE '.$this->table.' '.$this->generateUpdate().$this->generateWhere().$this->generateGroupBy().$this->generateOrderBy().$this->generateLimit();
    }
	
	public function generateUpdate(){
        $update = array();
        foreach($this->set as $k => $v){
            $update[] = $k.' = \''.$v.'\'';
        }
        
        return ' SET '.implode(', ', $update);
    }
	
	
}
