<?php
namespace Sequence\QueryPart;
/**
 * The SELECT clause of an Select Query
 * @author luwdo
 */
class SelectClause {
	public $operand = null;
	
	public function __toString() {
		return "SELECT {$this->operand}";
	}
}
