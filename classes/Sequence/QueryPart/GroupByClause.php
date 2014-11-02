<?php
namespace Sequence\QueryPart;
/**
 * The GROUP BY clause of an groupable Query
 * @author luwdo
 */
class GroupByClause {
	public $operand = null;
	
	public function __toString() {
		return "GROUP BY {$this->operand}";
	}
}
