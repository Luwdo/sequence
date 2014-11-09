<?php
namespace Sequence\QueryPart;
/**
 * Part of an update query consisting of a column and value
 * @author luwdo
 */
class SetItem extends Item{
	/**
	 * value or query
	 * @var type 
	 */
	public $operand;
	
	public $column;
	
	public function __toString() {
		return "{$this->column} = {$this->operand}";
	}
	
}
