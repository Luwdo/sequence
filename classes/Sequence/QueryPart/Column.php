<?php
namespace Sequence\QueryPart;
/**
 * Column of a query
 * @author luwdo
 */
class Column {
	public $columnName = null;
	public $tableAlias = null;
	
	public function __toString() {
		$alias = '';
		if($this->tableAlias !== null){
			$alias = "{$this->tableAlias}.";
		}
		return "{$alias}`{$this->columnName}`";
	}
}
