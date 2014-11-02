<?php
namespace Sequence\QueryPart;
/**
 * Description of UpdateSet
 *
 * @author luwdo
 */
class UpdateSet {
	public $tables = null;
	
	public function __toString() {
		return implode(', ', $this->tables);
	}
}
