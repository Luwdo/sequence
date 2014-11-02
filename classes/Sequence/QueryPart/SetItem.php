<?php
namespace Sequence\QueryPart;
/**
 * Description of SetItem
 * Part of an update query consisting of a column and value
 * @author luwdo
 */
class SetItem {
	public $column;
	public $value;
	
	public function __toString() {
		return "{$this->column} = {$this->value}";
	}
	
}
