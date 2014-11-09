<?php
namespace Sequence;
/**
 * Description of filterable_query
 *
 * @author luwdo
 */
abstract class FilterableQuery extends Query{
	
	/**
	 *
	 * @var QueryPart\WhereSet or WhereItem 
	 */
	 public $where = null;
	 
	 /**
	  *
	  * @var QueryPart\OrderbySet or QueryPart\OrderbyItem
	  */
	 public $orderBy = null;
	 
	 /**
	  *
	  * @var QueryPart\JoinItem or QueryPart\JoinSet
	  */
	 public $join = null;
	 
	 /**
	  *
	  * @var QueryPart\Limit
	  */
	 public $limit = null;
	 
	 /**
	  * 
	  * @return string
	  */
	 public function generateWhere(){
		if($this->where != null){
			return "WHERE {$this->where}";
		}
		return "";
	 }
	 
	 /**
	  * 
	  * @return string
	  */
	 public function generateOrderBy(){
		 if($this->orderBy != null){
			return "ORDER BY {$this->orderBy}";
		 }
		 return "";
	 }
	 
	 /**
	  * 
	  * @return string
	  */
	 public function generateJoins(){
		 if($this->join != null){
			return "{$this->join}";
		 }
		 return "";
	 }
	 
	 /**
	  * 
	  * @return string
	  */
	 public function generateLimit(){
		 if($this->limit != null){
			 return "LIMIT {$this->limit}";
		 }
		 return "";
	 }
	 
	 /**
	 * 
	 * @return string
	 */
	public function generateFrom(){
		if($this->operand != null){
			return "FROM {$this->operand}";
		}
		return "";
	}
	
	public function __toString() {
		"{$this->generateJoins()} {$this->generateWhere()} {$this->generateGroupBy()} {$this->generateOrderBy()} {$this->generateLimit()}";
	}
	 
	 
	 public function where($operand){
		 
		 
	 }
	 
	 public function wherePrimitive($operand){
		 
		 
	 }
	 
	 
}
