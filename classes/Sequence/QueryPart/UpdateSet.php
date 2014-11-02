<?php
namespace Sequence\QueryPart;
/**
 * A set of UpdateItems in update query
 * @author luwdo
 */
class UpdateSet {
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
