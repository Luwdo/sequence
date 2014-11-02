<?php
namespace Sequence\QueryPart;
/**
 * The INSERT INTO clause of an insert query
 * @author luwdo
 */
class InsertClause {
	public $table = null;
	public $operand = null;
	
	public function __toString() {
		return "INSERT INTO {$this->table} ({$this->operand})";
	}
	
}
