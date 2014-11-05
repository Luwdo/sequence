<?php
namespace Sequence\QueryPart;
/**
 * A set of SelectItem in an select query
 * @author luwdo
 */
class SelectSet extends QuerySet{
	public $operands = null;
	
	public function __toString() {
		return implode(', ', $this->operands);
	}
}
