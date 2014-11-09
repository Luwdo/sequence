<?php
namespace Sequence\QueryPart;
/**
 * Item that you are operating on
 * @author luwdo
 */
class Operand extends Part{
	/**
	 * colum or table or query
	 * @var mixed 
	 */
	public $target = null;
	public $alias = null;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return "{$this->target}{$alias}";
	}
}
