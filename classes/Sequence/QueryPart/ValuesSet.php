<?php
namespace Sequence\QueryPart;
/**
 * A set of values in an insert query
 * @author luwdo
 */
class ValuesSet extends Set{
	/**
	 * array of ValueItem
	 * @var array 
	 */
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
