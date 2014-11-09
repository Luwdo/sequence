<?php
namespace Sequence\QueryPart;
/**
 * Part of an insert query consisting of the a column name;
 * @author luwdo
 */
class InsertItem extends Item{
	
	/**
	 * column
	 * @var type 
	 */
	public $operand = null;
	
	public function __toString() {
		return $this->operand;
	}
}
