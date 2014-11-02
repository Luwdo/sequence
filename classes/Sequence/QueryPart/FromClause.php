<?php
namespace Sequence\QueryPart;
/**
 * Description of FromClause
 *
 * @author luwdo
 */
class FromClause {
	public $table = null;
	public $alias = null;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return "FROM {$this->table}{$alias}";
	}
}
