<?php
namespace Sequence;
/**
 * Description of delete_query
 *
 * @author luwdo
 */
class DeleteQuery extends FilterableQuery{
	/**
	 *
	 * @var QueryPart\DeleteClause 
	 */
	public $delete;
	
	
	public function generateDelete(){
		if($this->delete != null){
			return "DELETE {$this->delete}";
		}
		return "DELETE";
	}

	public function __toString() {
		return "{$this->generateDelete()} {$this->generateFrom()} ".parent::__toString();
	}
	

}
