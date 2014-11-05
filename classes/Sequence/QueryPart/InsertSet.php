<?php
namespace Sequence\QueryPart;
/**
 * A set of InsertItems in an update query
 * @author luwdo
 */
class InsertSet extends QuerySet{
	/**
	 * columns
	 * @var type 
	 */
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
	
}
