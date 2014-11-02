<?php
namespace Sequence\QueryPart;
/**
 * Description of UpdateSet
 * A set of UpdateItems in update query
 * @author luwdo
 */
class UpdateSet {
	public $tables = null;
	
	public function __toString() {
		return implode(', ', $this->tables);
	}
}