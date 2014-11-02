<?php
namespace Sequence\QueryPart;
/**
 * Description of SetClause
 *
 * @author luwdo
 */
class SetClause {
	public $operand = null;
	
	public function __toString() {
		return "SET {$this->operand}";
	}
}
