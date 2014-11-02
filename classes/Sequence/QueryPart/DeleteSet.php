<?php
namespace Sequence\QueryPart;
/**
 * A set of DeleteItems in an Delete query
 * @author luwdo
 */
class DeleteSet {
	/**
	 * table
	 * @var type 
	 */
	public $operands = null;
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
