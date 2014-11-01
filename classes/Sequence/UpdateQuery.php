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
	
	/**
	 * Declare what content needs to be set within this query.
	 * 
	 * @param array $values An associative array of field name => value.
	 * @return \query The revised query
	 * @throws Exception when invalid $values are provided or $values is empty
	 */
    public function set($values) {
        if(!is_array($values))
            throw new Exception('Set values must be an array');
		
        if(count($values) == 0)
            throw new Exception('Set values must not be an empty array');
		
        $this->set = array_merge($this->set, $values);
		
        return $this;
    }
	
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
