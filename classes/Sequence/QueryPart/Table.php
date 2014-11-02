<?php
/**
 * Table selection in a query
 * @author luwdo
 */
class Table {
	public $tableName = null;
	
	public function __toString() {
		return "`{$this->tableName}`";
	}
	
}
