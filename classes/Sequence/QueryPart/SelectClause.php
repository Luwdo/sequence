<?php
namespace Sequence\QueryPart;
/**
 * Description of SelectClause
 *
 * @author luwdo
 */
class SelectClause {
	public $operand = null;
	
	public function __toString() {
		return "SELECT {$this->operand}";
	}
}
