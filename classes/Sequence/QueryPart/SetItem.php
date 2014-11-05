<?php
namespace Sequence\QueryPart;
/**
 * Part of an update query consisting of a column and value
 * @author luwdo
 */
class SetItem extends QueryItem{
	public $column;
	public $value;
	
	public function __toString() {
		return "{$this->column} = {$this->value}";
	}
	
}
