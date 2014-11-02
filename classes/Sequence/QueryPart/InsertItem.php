<?php
namespace Sequence\QueryPart;
/**
 * Part of an insert query consisting of the a column name;
 * @author luwdo
 */
class InsertItem {
	public $column = null;
	
	public function __toString() {
		return $this->column;
	}
}
