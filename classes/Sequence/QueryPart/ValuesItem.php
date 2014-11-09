<?php
namespace Sequence\QueryPart;
/**
 * Part of an insert query consisting of values;
 * @author luwdo
 */
class ValuesItem extends Item{
	/**
	 * value
	 * @var type 
	 */
	public $operand = null;
	
	public function __toString() {
		if(is_array($this->operand)){
			return '('.implode(', ', $this->operand).')';			
		}
		else return "({$this->operand})";
	}
}
