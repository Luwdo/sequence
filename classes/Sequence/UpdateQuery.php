<?php
namespace Sequence;
/**
 * Description of update_query
 *
 * @author luwdo
 */
class UpdateQuery extends FilterableQuery{
	/**
	 *
	 * @var QueryPart\UpdateItem or QueryPart\UpdateSet
	 */
	public $update = null;
	
	/**
	 *
	 * @var QueryPart\SetItem or  QueryPart\SetSet
	 */
	public $set = null;
	
	public function generateUpdate(){
		return "UPDATE {$this->update}";
	}
	
	public function generateSet(){
		return "SET {$this->set}";
	}
	
	public function __toString() {
		return "{$this->generateUpdate()} {$this->generateSet()} ".parent::__toString();
	}
	

	
}
