<?php
namespace Sequence\QueryPart;
/**
 * A set of JoinItems in an update query
 * @author luwdo
 */
class JoinSet extends QuerySet{
	public $operands = null;
	
	public function __toString() {
		return implode(' ', $this->operands);
	}
}
