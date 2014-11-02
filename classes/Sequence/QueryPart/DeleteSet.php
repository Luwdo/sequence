<?php
namespace Sequence\QueryPart;
/**
 * Description of DeleteSet
 *
 * @author luwdo
 */
class DeleteSet {
	public $tables = null;
	public function __toString() {
		return implode(', ', $this->tables);
	}
}
