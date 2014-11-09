<?php
namespace Sequence\QueryPart;
/**
 * Part of an Select query consisting of a operand and alias
 * @author luwdo
 */
class SelectItem extends Item{
	/**
	 * Operand or Column or Query 
	 * @var type 
	 */
	public $operand = null;

	public function __toString() {
		return $this->operand;
	}
	
}
