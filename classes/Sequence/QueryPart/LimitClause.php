<?php
namespace Sequence\QueryPart;
/**
 * Description of LimitClause
 *
 * @author luwdo
 */
class LimitClause {
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
