<?php
namespace Sequence\QueryPart;
/**
 * Description of InsertSet
 * A set of insertItems in an update query
 * @author luwdo
 */
class InsertSet {
	public $columns = null;
	
	public function __toString() {
		return implode(', ', $this->columns);
	}
	
}
