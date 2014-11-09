<?php
namespace Sequence;
/**
 * Description of insert_query
 *
 * @author luwdo
 */
class InsertQuery extends ExecutableQuery{
	/**
	 * 
	 * @var QueryPart\InsertItem or QueryPart\InsertSet
	 */
	public $insert = null;
	
	/**
	 *
	 * @var QueryPart\ValuesITem or QueryPart\ValuesSet
	 */
	public $values = null;
	
	public function generateInsert(){
		return "INSERT INTO {$this->operand} ({$this->insert})";
	}
	
	public function generateValues(){
		return "VALUES {$this->values}";
	}
	
	public function __toString() {
		return "{$this->generateInsert()} {$this->generateValues()}";
	}
	
	
	
}
