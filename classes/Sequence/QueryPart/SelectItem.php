<?php
namespace Sequence\QueryPart;
/**
 * Description of SelectSet
 *
 * @author luwdo
 */
class SelectItem {
	public $operand = null;
	public $tableAlias = null;
	public $alias = null;

	public function __toString() {
		if($this->tableAlias !== null && !is_string($this->operand)){
			throw new Exception('Cannot table alias a none string operand.');
		}

		$tableAlias = '';
		if($this->tableAlias !== null){
			$tableAlias = "{$this->tableAlias}.";
		}
		
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		
		return $tableAlias.$this->operand.$alias;
	}
	
	//table_alias.(SELECT ) as alias
	
}
