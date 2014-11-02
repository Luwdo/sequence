<?php
namespace Sequence\QueryPart;
/**
 * Description of InsertClause
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
