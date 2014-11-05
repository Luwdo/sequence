<?php
namespace Sequence\QueryPart;
/**
 * The LIMIT clause of an limitable Query
 * @author luwdo
 */
class LimitClause extends QueryClause{
	public $count = null;
	public $offset = null;
	
	public function __toString() {
		$limit = 'LIMIT '.$this->count;
		if($this->offset !== null){
			$limit .= ', '.$this->offset;
		}
		return $limit;
	}
}
