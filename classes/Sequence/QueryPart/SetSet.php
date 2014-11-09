<?php
namespace Sequence\QueryPart;
/**
 * A set of updateItems in an update query
 * @author luwdo
 */
class SetSet extends Set{
	/**
	 * array of SetItem
	 * @var array 
	 */
	public $operands = null;

	public function __toString() {
		return implode(', ', $this->operands);
	}
}
