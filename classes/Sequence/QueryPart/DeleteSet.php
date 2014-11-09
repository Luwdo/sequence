<?php
namespace Sequence\QueryPart;
/**
 * A set of DeleteItems in an Delete query
 * @author luwdo
 */
class DeleteSet extends Set{
	/**
	 * array of DeleteItem
	 * @var array
	 */
	public $operands = null;

	
	//DELETE 
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
