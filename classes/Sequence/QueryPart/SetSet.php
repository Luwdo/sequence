<?php
namespace Sequence\QueryPart;
/**
 * A set of updateItems in an update query
 * @author luwdo
 */
class SetSet {
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
