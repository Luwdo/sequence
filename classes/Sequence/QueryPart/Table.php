<?php
/**
 * Description of Table
 *
 * @author luwdo
 */
class Table {
	public $tableName = null;
	
	public function __toString() {
		return "`{$this->tableName}`";
	}
	
}
