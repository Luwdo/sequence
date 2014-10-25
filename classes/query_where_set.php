<?php

class query_where_set{
    public $where = array();
    public $type;
    
    private $params = array();
    private $separator;
    
    const OR_SET = 0;
    const AND_SET = 1;
    
    public function __construct($where, $type = self::AND_SET) {
        $this->where = $where;
        $this->type = $type;
        $this->separator = ($type == self::AND_SET ? 'AND' : 'OR');
        //i($this->separator);die;
    }
    
    public function generate() {
        if(count($this->where) == 0)
            return '';
        
        $this->params = array();
        $where_parts = array();
        foreach($this->where as $k => $v){
            if(is_array($v)) {
                $n = count($v);
                foreach($v as $p){
                    $this->params[] = $p;
                }
            } else if (is_object($v) && $v instanceof query_where_set) {
                $where_parts[] = '('.$v->generate().')';
                $this->params = array_merge($this->params, $v->get_params());
                continue;
            } else {
                $n = 1;
                $this->params[] = $v;
            }
            
            $where_parts[] = $this->generate_unparameterized_expression($k, $n);
        }
        
        return implode(' '.$this->separator.' ', $where_parts);
    }
     
    public function generate_unparameterized_expression($key, $num) {
         $operators = array('>', '<', '>=', '<=', '!=', 'LIKE', 'NOT LIKE');
         $use_operator = '=';
         foreach($operators as $operator) {
            if(strpos($key, $operator) !== false) {
               $use_operator = $operator;
               break;
            }
         }
         
         $key = trim(str_replace($operator, '', $key));
         if($num > 1) {
            if((($in = $use_operator == '=') || $use_operator == '!=')) {
                $exp = "`$key`";
                if($in)
                    $exp .= ' IN';
                else
                    $exp .= ' NOT IN';
                
                $exp .= ' (?'.str_repeat(', ?', $num - 1).')';
            } 
            else {
                $exp = "`$key` $use_operator ?";
                for($i = 1; $i < $num; $i++) {
                    $exp .= " OR `$key` $use_operator ?";
                }
            }
         } else
            $exp = "`$key` $use_operator ?";
         
         return "($exp)";
    }
    
    public function get_params() {
        return $this->params;
    }
}