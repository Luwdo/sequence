<?php
namespace Sequence\QueryPart;
/**
 * A set of WhereConditions in an filterable query.
 * @author luwdo
 */
class WhereSet extends Set{
	/**
	 * 
	 * @var WhereItem or WhereSet
	 */
	public $operands = null;
	
	public $operator = null;		
	
	//operators
	const _AND = 'AND';
	const _OR = 'OR';
	
	/**
	 * 
	 * @param type $operator
	 * @param type $operands
	 */
	public function __construct($operator, $operands) {
		$this->operator = $operator;
		$this->operands = $operands;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function __toString() {
		return implode(" {$this->operator} ", $this->operands);
	}
}
