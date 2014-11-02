<?php
namespace Sequence\QueryPart;
/**
 * Description of SetItem
 *
 * @author luwdo
 */
class SetItem {
	public $column;
	public $value;
	
	public function __toString() {
		return "{$this->column} = {$this->value}";
	}
	
}
