<?php
namespace Sequence\QueryPart;
/**
 * The JOIN clause of an joinable Query
 * @author luwdo
 */
class JoinClause {
	public $table = null;
	public $alias = null;
	/**
	 * Query WhereSet or QueryCondition
	 * @var type 
	 */
	public $operand = null;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return "JOIN {$this->table}{$alias} ON {$this->operand}";
	}
}
