<?php
namespace Sequence\QueryPart;
/**
 * The JOIN clause of an joinable Query
 * @author luwdo
 */
class JoinClause extends QueryClause{
	public $operand = null;
	
	public function __toString() {
		return "{$this->operand}";
	}
}
