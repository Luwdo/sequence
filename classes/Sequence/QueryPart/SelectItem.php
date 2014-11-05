<?php
namespace Sequence\QueryPart;
/**
 * Part of an Select query consisting of a operand and alias
 * @author luwdo
 */
class SelectItem extends QueryItem{
	//Column or query
	public $operand = null;
	
	//public $tableAlias = null;
	public $alias = null;

	public function __toString() {
		if($this->tableAlias !== null && !is_string($this->operand)){
			throw new Exception('Cannot table alias a none string operand.');
		}

//		$tableAlias = '';
//		if($this->tableAlias !== null){
//			$tableAlias = "{$this->tableAlias}.";
//		}
		
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return $this->operand.$alias;
		//return $tableAlias.$this->operand.$alias;
	}
	
	//table_alias.(SELECT ) as alias
	
}
