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
	 
	 public function generateWhere() {
        
        if(count($this->where) == 0)
            return '';
        
        $set = new QueryWhereSet($this->where);
        
        $cond = $set->generate();
        $this->params = $set->getParams();
        return ' WHERE '.$cond;
        
        /*$where_parts = array();
        foreach($this->where as $k => $v){
            if(is_array($v)){
                $n = count($v);
                foreach($v as $p){
                    $this->params[] = $p;
                }
            }
            else{
                $n = 1;
                $this->params[] = $v;
            }
            $where_parts[] = $this->generate_unparameterized_expression($k, $n);
        }
        return ' WHERE '.implode(' AND ', $where_parts);*/
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
