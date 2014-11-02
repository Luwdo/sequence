<?php
namespace Sequence\QueryPart;
/**
 * A set of DeleteItems in an Delete query
 * @author luwdo
 */
class DeleteSet {
	public $tables = null;
	public function __toString() {
		return implode(', ', $this->tables);
	}
}
