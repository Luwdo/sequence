<?php
namespace Sequence\QueryPart;
/**
 * Part of an join statement;
 * @author luwdo
 */
class JoinItem extends Item{
	/**
	 * table or query
	 * @var type 
	 */
	public $operand = null;
	
	public $alias = null;
	/**
	 * Query WhereSet or QueryCondition
	 * @var type 
	 */
	public $condition = null;
	public $type = null;
	
	//join types
	const JOIN = 'JOIN';//inner join
	const LEFT_JOIN = 'LEFT JOIN';
	const RIGHT_JOIN = 'RIGHT JOIN';
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return "{$this->type} {$this->operand}{$alias} ON {$this->condition}";
	}
}
