<?php
namespace Sequence\QueryPart;
/**
 * Description of ValuesClause
 * The VALUES clause of an insert query
 * @author luwdo
 */
class ValuesClause {
	public $operand = null;
	
	public function __toString() {
		return "VALUES {$this->operand}";
	}
}
