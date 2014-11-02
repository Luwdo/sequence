<?php
namespace Sequence\QueryPart;
/**
 * Description of WhereSet
 *
 * @author luwdo
 */
class WhereSet {
	//put your code here
	public $operator = null;
	public $operands = null;		
	
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
