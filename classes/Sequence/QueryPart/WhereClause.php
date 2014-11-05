<?php
namespace Sequence\QueryPart;
/**
 * The WHERE clause of an filterable query
 * @author luwdo
 */
class WhereClause extends QueryClause{
	public $operand = null;
	
	public function __toString() {
		return "WHERE {$this->operand}";
	}
}
