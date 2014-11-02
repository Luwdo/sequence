<?php
namespace Sequence\QueryPart;
/**
 * Description of DeleteClause
 *
 * @author luwdo
 */
class DeleteClause {
	public $operand = null;
	public function __toString() {
		return "DELETE {$this->operand}";
	}
}
