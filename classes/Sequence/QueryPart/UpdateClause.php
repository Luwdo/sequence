<?php
namespace Sequence\QueryPart;
/**
 * Description of UpdateClause
 *
 * @author luwdo
 */
class UpdateClause {
	public $operand = null;
	
	public function __toString() {
		return "UPDATE {$this->operand}";
	}
}
