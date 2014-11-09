<?php
namespace Sequence\QueryPart;
/**
 * Part of an orderable query consisting of column and direction.
 * @author luwdo
 */
class OrderByItem extends Item{
	public $direction = null;
	/**
	 * column name
	 * @var type 
	 */
	public $operand = null;
	
	//derections
	const ASC = 'ASC';
	const DESC = 'DESC';
	
	public function __toString() {
		$direction = '';
		if($this->direction !== null){
			$direction = " {$this->direction}";
		}
		return "{$this->operand}{$direction}";
	}
	
}
