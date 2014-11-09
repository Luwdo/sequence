<?php
namespace Sequence\QueryPart;
/**
 * A set of UpdateItems in update query
 * @author luwdo
 */
class UpdateSet extends Set{
	/**
	 * array of UpdateItem
	 * @var array
	 */
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
