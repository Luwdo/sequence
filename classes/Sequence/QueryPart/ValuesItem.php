<?php
namespace Sequence\QueryPart;
/**
 * Part of an insert query consisting of values;
 * @author luwdo
 */
class ValuesItem extends QueryItem{
	public $values = null;
	
	public function __toString() {
		if(is_array($this->values)){
			return '('.implode(', ', $this->values).')';			
		}
		else return "({$this->values})";
	}
}
