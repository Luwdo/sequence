<?php
namespace Sequence;
/**
 * Description of select_query
 *
 * @author luwdo
 */
class SelectQuery extends DataYieldingQuery{
	/**
	 *
	 * @var QueryPart\SelectItem or QueryPart\SelectSet
	 */
	public $select = null;
	
	public function generatSelect(){
		return "SELECT {$this->select}";
	}
	
	public function __toString() {
		return "{$this->generatSelect()} {$this->generateFrom()}".parent::__toString();
		
	}
	
	
	
}
