<?php
namespace Sequence\QueryPart;
/**
 * A set of JoinItems in an update query
 * @author luwdo
 */
class JoinSet extends Set{
	/**
	 * Array of JoinItem
	 * @var array 
	 */
	public $operands = null;

	public function __toString() {
		return implode(' ', $this->operands);
	}
}
