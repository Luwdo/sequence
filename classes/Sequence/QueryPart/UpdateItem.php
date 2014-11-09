<?php
namespace Sequence\QueryPart;
/**
 * Part of an update query consisting of the targeted table and its alias.
 * @author luwdo
 */
class UpdateItem extends Item{
	/**
	 * query or column or operand
	 * @var type 
	 */
	public $operand = null;
	
	//UPDATE items,month SET items.price=month.price WHERE items.id=month.id;
	
	public function __toString() {
		return $this->operand;
	}
}
