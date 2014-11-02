<?php
namespace Sequence\QueryPart;
/**
 * The SET clause of an update Query
 * @author luwdo
 */
class SetClause {
	public $operand = null;
	
	public function __toString() {
		return "SET {$this->operand}";
	}
}
