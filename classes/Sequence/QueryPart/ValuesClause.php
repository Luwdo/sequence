<?php
namespace Sequence\QueryPart;
/**
 * The VALUES clause of an insert query
 * @author luwdo
 */
class ValuesClause extends QueryClause{
	public $operand = null;
	
	public function __toString() {
		return "VALUES {$this->operand}";
	}
}
