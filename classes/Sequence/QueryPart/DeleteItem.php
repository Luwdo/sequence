<?php
namespace Sequence\QueryPart;
/**
 * Part of an DELETE query consisting of the a table;
 * @author luwdo
 */
class DeleteItem {
	public $table = null;
	public function __toString() {
		return $this->table;
	}
}
