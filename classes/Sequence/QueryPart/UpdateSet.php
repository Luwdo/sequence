<?php
namespace Sequence\QueryPart;
/**
 * A set of UpdateItems in update query
 * @author luwdo
 */
class UpdateSet extends QuerySet{
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
