<?php
namespace Sequence\QueryPart;
/**
 * Description of InsertItem
 * Part of an insert query consisting of the a column name name;
 * @author luwdo
 */
class InsertItem {
	public $column = null;
	
	public function __toString() {
		return $this->column;
	}
}
