<?php
namespace Sequence\QueryPart;
/**
 * Description of SelectSet
 *
 * @author luwdo
 */
class SelectSet {
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
