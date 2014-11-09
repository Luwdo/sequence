<?php
namespace Sequence\QueryPart;
/**
 * Description of WherePrimitive
 * 
 * @author luwdo
 * 
 */
abstract class Primitive extends Part {
	public $value = null;
	
	/**
	 * 
	 * @return string
	 */
	public function __toString() {
		return '"'.\Sequence\Query::sanitize($this->value).'"';
	}
	
}
