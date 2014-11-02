<?php
namespace Sequence\QueryPart;
/**
 * Description of WhereCondition
 *
 * @author luwdo
 */
class WhereCondition {
	public $leftHandSide = null;
	public $operator = null;
	public $rightHandSide = null;
	
	//binary operators
	const NULL_SAFE_EQUALS = '<=>';
	const EQUALS = '=';
	const NOT_EQUAL = '!=';
	const GEATER_THEN = '>';
	const LESS_THEN = '<';
	const GEATER_THEN_OR_EQUAL = '>=';
	const LESS_THEN_OR_EQUAL = '<=';
	const IN = 'IN';
	const NOT_IN = 'NOT IN';
	
	//unary
	const NOT = '!';
	const BIT_INVERSION = '~';
	
	/**
	 * 
	 * @return string
	 */
	public function __toString() {
		//unary without an opperator
		if($this->operator == null && $this->rightHandSide == null){
			return (string)$this->leftHandSide;
		}
		//unary with an opperator
		if($this->rightHandSide == null){
			return "({$this->operator}({$this->leftHandSide}))";
		}
		//binary
		$rightHand = $this->rightHandSide;
		if(is_array($rightHand)){
			$rightHand = '('.implode(', ', $rightHand).')';
		}
		return "({$this->leftHandSide} {$this->operator} {$rightHand})";
	}
}
