<?php
namespace Sequence\QueryPart;
/**
 * Description of UpdateClause
 * The UPDATE clause of an update query
 * @author luwdo
 */
class UpdateClause {
	public $operand = null;
	
	public function __toString() {
		return "UPDATE {$this->operand}";
	}
}
