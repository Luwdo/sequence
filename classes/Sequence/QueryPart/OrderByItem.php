<?php
namespace Sequence\QueryPart;
/**
 * Part of an orderable query consisting of column and direction.
 * @author luwdo
 */
class OrderByItem extends QueryItem{
	public $column = null;
	public $direction = null;
	
	//derections
	const ASC = 'ASC';
	const DESC = 'DESC';
	
	public function __toString() {
		$direction = '';
		if($this->direction !== null){
			$direction = " {$this->direction}";
		}
		return "{$this->column}{$direction}";
	}
	
}
