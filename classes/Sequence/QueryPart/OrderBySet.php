<?php
namespace Sequence\QueryPart;
/**
 * A set of OrderByItem in an orderable query
 * @author luwdo
 */
class OrderBySet {
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
