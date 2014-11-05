<?php
namespace Sequence\QueryPart;
/**
 * Table selection in a query
 * @author luwdo
 */
class Table extends QueryPart{
	public $tableName = null;
	
	public function __toString() {
		return "`{$this->tableName}`";
	}
	
}
