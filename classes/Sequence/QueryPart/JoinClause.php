<?php
namespace Sequence\QueryPart;
/**
 * Description of JoinClause
 *
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
