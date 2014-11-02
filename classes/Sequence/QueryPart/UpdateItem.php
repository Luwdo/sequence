<?php
namespace Sequence\QueryPart;
/**
 * Description of UpdateItem
 *
 * @author luwdo
 */
class UpdateItem {
	public $tableName = null;
	public $alias = null;
	
	//UPDATE items,month SET items.price=month.price WHERE items.id=month.id;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return $this->tableName.$alias;
	}
}
