<?php
namespace Sequence\QueryPart;
/**
 * Description of ValuesItem
 * Part of an insert query consisting of values;
 * @author luwdo
 */
class ValuesItem {
	public $values = null;
	
	public function __toString() {
		if(is_array($this->values)){
			return '('.implode(', ', $this->values).')';			
		}
		else return "({$this->values})";
	}
}
