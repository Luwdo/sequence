<?php
namespace Sequence\QueryPart;
/**
 * Part of an DELETE query consisting of the a table;
 * @author luwdo
 */
class DeleteItem {
	/**
	 * table
	 * @var type 
	 */
	public $operand = null;
	public function __toString() {
		return $this->operand;
	}
}
