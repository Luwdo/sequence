<?php
namespace Sequence;
/**
 * Description of select_query
 *
 * @author luwdo
 */
class SelectQuery extends DataYieldingQuery{
	/**
	 *
	 * @var QueryPart\SelectClause
	 */
	public $selectClause = null; // if array assming that you are aliasing it?
	
	public function __toString() {
		
		
		//parent::__toString();
	}
	
	
	public function generateQuery(){
        $this->params = array();
        return 'SELECT '.$this->generateSelect().' FROM '.$this->table.$this->generateWhere().$this->generateGroupBy().$this->generateOrderBy().$this->generateLimit();
    }
	
	
	public function generateSelect(){
        if(!is_array($this->select)){
            if($this->result_type == self::COUNT){
                return 'COUNT('.$this->select.')';
            }
            return $this->select;
        }
        
        //aliasing should be done latter all at once
        /*$select_parts = array();
        foreach($this->select as $alias => $column){
            $select_parts[] = $column.' AS '.$alias;
        }
        return implode(', ', $select_parts);*/
    }
	
	
}
