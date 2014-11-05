<?php
namespace Sequence\QueryPart;
/**
 * Part of an update query consisting of the targeted table and its alias.
 * @author luwdo
 */
class UpdateItem extends QueryItem{
	public $operand = null;
	public $alias = null;
	
	//UPDATE items,month SET items.price=month.price WHERE items.id=month.id;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = " AS {$this->alias}";
		}
		return $this->operand.$alias;
	}
}
