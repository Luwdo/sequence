<?php
namespace Sequence\QueryPart;
/**
 * A set of values in an insert query
 * @author luwdo
 */
class ValuesSet extends QuerySet{
	public $values = null;
	
	public function __toString() {
		return implode(', ', $this->values);
	}
}
