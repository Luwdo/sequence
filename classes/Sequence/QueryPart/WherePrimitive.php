<?php
namespace Sequence\QueryPart;
/**
 * Description of WherePrimitive
 *
 * @author luwdo
 * @method mixed and(mixed $operand)
 */
class WherePrimitive extends WhereOperand{
	
	/**
	 *
	 * @var Primitive 
	 */
	public $primitive = null;
	
	public function __call($name, $arguments) {
		if($name == 'and'){
			return call_user_func_array(array($this, '_and'), $arguments);
		}
	}
	
	
	/**
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->primitive;
	}
	
	/**
	 * 
	 * @param type $operand
	 */
	public function _and($operand) {
		
		//new WhereSet();
	}
	
	
}
