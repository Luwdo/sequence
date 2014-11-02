<?php
namespace Sequence\QueryPart;
/**
 * The FROM clause of an select Query
 * @author luwdo
 */
class FromClause {
	public $operand = null;
	public $alias = null;
	
	public function __toString() {
		$alias = '';
		if($this->alias !== null){
			$alias = "AS {$this->alias}";
		}
		return "FROM {$this->operand}{$alias}";
	}
}
