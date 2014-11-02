<?php
namespace Sequence\QueryPart;
/**
 * Description of WhereClause
 *
 * @author luwdo
 */
class WhereClause {
	public $operand = null;
	
	public function __toString() {
		return "WHERE {$this->operand}";
	}
}
