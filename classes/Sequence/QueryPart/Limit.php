<?php
namespace Sequence\QueryPart;
/**
 * The LIMIT clause of an limitable Query
 * @author luwdo
 */
class Limit extends QueryPart{	
	//public $operand = null;
	public $count = null;
	public $offset = null;
	
	public function __toString() {
		$limit = $this->count;
		if($this->offset !== null){
			$limit .= ', '.$this->offset;
		}
		return $limit;
	}
}
