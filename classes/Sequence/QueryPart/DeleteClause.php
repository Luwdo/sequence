<?php
namespace Sequence\QueryPart;
/**
 * The DELETE clause of an Delete Query
 * @author luwdo
 */
class DeleteClause {
	public $operand = null;
	public function __toString() {
		return "DELETE {$this->operand}";
	}
}
