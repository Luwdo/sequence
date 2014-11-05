<?php
namespace Sequence\QueryPart;
/**
 * The ORDER BY clause of an orderable Query
 * @author luwdo
 */
class OrderByClause extends QueryClause{
	//OrderByItem or OrderBySet
	public $operand = null;
	
	public function __toString() {
		return "ORDER BY {$this->operand}";
	}
}
