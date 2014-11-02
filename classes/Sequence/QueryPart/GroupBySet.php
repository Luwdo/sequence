<?php
namespace Sequence\QueryPart;
/**
 * A set of GroupByItem in an orderable query
 * @author luwdo
 */
class GroupBySet {
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
