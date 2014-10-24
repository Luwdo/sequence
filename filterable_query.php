<?php
/**
 * Description of filterable_query
 *
 * @author luwdo
 */
class filterable_query extends query{
	 public $where = array();
	 public $limit = null;
	 public $offset = null;
	 public $order = array();
	 
	 public function generate_where() {
        
        if(count($this->where) == 0)
            return '';
        
        $set = new query_where_set($this->where);
        
        $cond = $set->generate();
        $this->params = $set->get_params();
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
	
	public function generate_order_by(){
        if(count($this->order) == 0) return '';
        $order_parts = array();
        foreach($this->order as $column => $direction){
            $order_parts[] = $column.' '.$direction;
        }
        return ' ORDER BY '.implode(', ', $order_parts);
    }
	
	public function generate_limit(){
        if(!is_numeric($this->limit)) return '';
        
        if($this->offset && $this->limit)
            return ' LIMIT '.$this->offset.', '.$this->limit;
        
        return ' LIMIT '.$this->limit;
    }
	 
}
