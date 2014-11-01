<?php
namespace Sequence;
/**
 * Description of filterable_query
 *
 * @author luwdo
 */
class FilterableQuery extends Query{
	 public $where = array();
	 public $limit = null;
	 public $offset = null;
	 public $order = array();
	 
	 
	 /**
	 * Return the first result row of the query. The query will
	 * be executed if necessary.
	 * 
	 * @return object The result row
	 */
    public function first(){
        foreach ($this->limit(1) as $row) 
			return $row;
    }
	 
	 /**
	 * Add more conditions to the current query.
	 * 
	 * @param type $conditions
	 * @return \query The new query
	 * @throws Exception
	 */
    public function where($conditions) {
        if(!is_array($conditions))
            throw new Exception('Where conditions must be an array');
		
        if(count($conditions) == 0)
            throw new Exception('Where conditions must not be an empty array');
		
        $this->where = array_merge($this->where, $conditions);
        return $this;
    }
	
	/**
	 * Declare that the result set should be ordered by the given field and direction,
	 * in addition to what the query currently orders by.
	 * 
	 * @param mixed $mixed Name of the column to order by, or an associative array containing field => direction
	 * @param type $default_direction Optional, when $mixed is a string column name, specifies the direction to sort by. 
	 * @return \query The revised query
	 */
    public function orderBy($mixed, $default_direction = 'ASC') {
        if(!is_array($mixed)) {
			$this->order[$mixed] = $default_direction;
			return $this;
		} 
		
		foreach($mixed as $column => $direction){
			if($direction != 'DESC' && $direction != 'ASC') $direction = $default_direction;
			$this->order[$column] = $direction;
		}
		
        return $this;
    }
	
	/**
	 * Declare that the result set should be limited by the given amount of rows, and 
	 * optionally offset by the given amount of rows.
	 * 
	 * @param int $limit The amount of rows to limit the query by.
	 * @param int $offset Optional, offset into the result set to start at
	 * @return \query The revised query
	 * @throws Exception Limit or offset is non-numeric
	 */
    public function limit($limit, $offset = null){
        if(!is_numeric($limit))
            throw new Exception('Limit must me numeric');
        if($offset != null && !is_numeric($offset))
            throw new Exception('Offset must me numeric');
        
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
	 
	 
	 public function generateWhere() {
        
        if(count($this->where) == 0)
            return '';
        
        $set = new QueryWhereSet($this->where);
        
        $cond = $set->generate();
        $this->params = $set->getParams();
        return ' WHERE '.$cond;
    }
	
	public function generateOrderBy(){
        if(count($this->order) == 0) return '';
        $order_parts = array();
        foreach($this->order as $column => $direction){
            $order_parts[] = $column.' '.$direction;
        }
        return ' ORDER BY '.implode(', ', $order_parts);
    }
	
	public function generateLimit(){
        if(!is_numeric($this->limit)) return '';
        
        if($this->offset && $this->limit)
            return ' LIMIT '.$this->offset.', '.$this->limit;
        
        return ' LIMIT '.$this->limit;
    }
	 
}
