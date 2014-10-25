<?php
class query{
    public $table = null;
    ///public $class = null;
    //public $select = '*'; // if array assming that you are aliasing it?
    //public $where = array();
    public $params = array();
   // public $limit = null;
   // public $offset = null;
    public $group = array();
  //  public $order = array();
  //  public $set = array();
    public $type = null;
    public $result = null;
//    public $result_type = null;
	
	public $stmt = null;
	
	public function __get($name)
    {
		if(in_array($name, array('affected_rows', 'errono', 'error_list', 'error', 'field_count', 'insert_id','num_rows','param_count','sqlstate'))){
			if(isset($this->stmt) && isset($this->stmt->$name)){
				return $this->stmt->$name;
			}
			return null;
		}
	}
            
    //result types
//    const SINGLE_OR_NULL = 1;
//    const MULTIBLE_OR_EMPTY_ARRAY = 2;
//    const COUNT = 3;
            
    //query types
//    const SELECT = 1;
//    const UPDATE = 2;
//    const INSERT = 3;
//    const DELETE = 4;
    
//    public function __construct($args = array()) {
//        foreach($this as $field => $value){
//            if(isset($args[$field])) $this->$field = $args[$field];
//        }
//    }
    
    public function __toString() {
            return $this->query_string();
    }
    
    //Object Manipulation
    
    //select
    public function select($select = null){
        $this->type = self::SELECT;
        if($select !== null ){
            $this->select = $select;
        }
        return $this;
    }
    public static function new_select($select = null){
        $query = new query();
        $query->type = self::SELECT;
        if($select !== null ){
            $query->select = $select;
        }
        return $query;
    }
    
    //------
    //Update
    public function update(){
        $this->type = self::UPDATE;
        return $this;
    }
    public static function new_update(){
        $query = new query();
        $query->type = self::UPDATE;
        return $query;
    }
    //------
    //isset
    public function insert(){
        $this->type = self::INSERT;
        return $this;
    }
    public static function new_insert(){
        $query = new query();
        $query->type = self::INSERT;
        return $query;
    }
    //------
    //delete
    public function delete(){
        $this->type = self::DELETE;
        return $this;
    }
    public static function new_delete(){
        $query = new query();
        $query->type = self::DELETE;
        return $query;
    }
    //------
    public function table($table){
        $this->table = '`'.$table.'`';
        return $this;     
    }
    
    public function where($conditions){
        if(!is_array($conditions))
            throw new Exception('Where conditions must be an array');
        if(count($conditions) == 0)
            throw new Exception('Where conditions must not be an empty array');
        $this->where = array_merge($this->where, $conditions);
        return $this;
    }
    
    public function set($values){
        if(!is_array($values))
            throw new Exception('Set values must be an array');
        if(count($values) == 0)
            throw new Exception('Set values must not be an empty array');
        $this->set = array_merge($this->set, $values);
        return $this;
    }
    
    public function order_by($mixed, $default_direction = 'ASC'){
        if(!is_array($mixed)) $this->order[$mixed] = $default_direction;
        else{
            foreach($mixed as $column => $direction){
                if($direction != 'DESC' && $direction != 'ASC') $direction = $default_direction;
                $this->order[$column] = $direction;
            }
        }
        return $this;
    }
    
    public function group_by($mixed){
        if(!is_array($mixed)) $this->group[] = $mixed;
        else{
            if(count($mixed) == 0)
                throw new Exception('Group by conditions must not be an empty array');
            $this->group = array_merge($this->group, $mixed);
        }
        return $this;
    }
    
    public function limit($limit, $offset = null){
        if(!is_numeric($limit))
            throw new Exception('Limit must me numeric');
        if($offset != null && !is_numeric($offset))
            throw new Exception('Offset must me numeric');
        
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
    
    public function first(){
        return $this->limit(1)->single_or_null();
    }
    
    public function single_or_null(){
        $this->result_type = self::SINGLE_OR_NULL;
        return $this;
    }
    
    public function result_class($class){
        $this->class = $class;
        return $this;
    }
    
    public function count(){
        $currrent_result_type = $this->result_type;
        $this->result_type = self::COUNT;
        $result = $this->run();
        $this->result_type = $currrent_result_type;
        return $result;
    }
    
    //public function greedy_search($field, $search){
    //    return $this->where(array($field.' LIKE' => ));
    //}
    
    //SQL Query Generation
    
    public function run(){
        $query = $this->generate_query();
        
        $mysqli_stmt = core::db()->prepare($query);
        
        if(!$mysqli_stmt){
            throw new Exception('Query Syntax Error : '.$query);
        }
        if(count($this->params) > 0){
            $params = $this->build_referenced_parameter_bindings();
            call_user_func_array(array($mysqli_stmt, 'bind_param'), $params);
        }
        
        if($mysqli_stmt->execute()){
            switch ($this->type){
                case self::SELECT:
                    $query_fields = $mysqli_stmt->result_metadata()->fetch_fields();
                    foreach($query_fields as $query_field){
                        $result[$query_field->name] = "";
                        $resultArray[$query_field->name] = &$result[$query_field->name];
                    }
                    call_user_func_array(array($mysqli_stmt, 'bind_result'), $resultArray);

                    $this->result = array();
                    while($mysqli_stmt->fetch()) {
                        if($this->result_type == self::COUNT){
                            $this->result = $resultArray['COUNT(*)'];
                            continue;
                        }                   
                        if($this->class !== null){
                           $this->result[] = new $this->class($resultArray);
                        }
                        else{
                           $this->result[] = (object)$resultArray;
                        }
                    }
                    break;
                case self::UPDATE:
                    $this->result = $mysqli_stmt->affected_rows;
                    break;
                case self::INSERT:
                    $this->result = $mysqli_stmt->insert_id;
                    break;
                case self::DELETE:
                    $this->result = $mysqli_stmt->affected_rows;
                    break;
            }
        }
        else{
            throw new Exception('Query failed Error : '.$mysqli_stmt->error );
        }
        if($this->result_type == self::SINGLE_OR_NULL){
            if(count($this->result) > 1 || count($this->result) == 0) return null;
            return $this->result[0];
        }
        
        return $this->result;
    }
    
    public function build_referenced_parameter_bindings(){
        $params = array();
        $types = $this->build_parameter_binding_types();
        $params[] = &$types;
        foreach($this->params as $k => $v){
            $params[] = &$this->params[$k];
        }
        return $params;
    }
    
    public function build_parameter_binding_types(){
        $types = '';                        
        foreach($this->params as $param) {        
            if(is_int($param)) {
                $types .= 'i';              //integer
            } elseif (is_float($param)) {
                $types .= 'd';              //double
            } elseif (is_string($param)) {
                $types .= 's';              //string
            } else {
                $types .= 'b';              //blob and unknown
            }
        }
        return $types; 
    }
    
    
    public static function sanatize($input){
        return mysql_real_escape_string($input);
    }
 /*   
    public function generate_query(){
        $this->params = array();
        
        if($this->type == self::SELECT){
            return 'SELECT '.$this->generate_select().' FROM '.$this->table.$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
        }
        else if($this->type == self::UPDATE){
            return 'UPDATE '.$this->table.' '.$this->generate_update().$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
        }
        else if($this->type == self::INSERT){
            return 'INSERT INTO '.$this->table.' '.$this->generate_insert();
        }
        else if($this->type == self::DELETE){
            return 'DELETE FROM '.$this->table.$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
        }
        else throw new Exception('Query type was not set');
        
    }
  */  
    public function query_string(){
        $query = $this->generate_query();
        
        foreach($this->params as $param){
            $pos = strpos($query,'?');
            if ($pos !== false) {
                $query = substr_replace($query,$param,$pos,1);
            }
        }
        return $query;
    }
    
//    public function generate_select(){
//        if(!is_array($this->select)){
//            if($this->result_type == self::COUNT){
//                return 'COUNT('.$this->select.')';
//            }
//            return $this->select;
//        }
//        
//        //aliasing should be done latter all at once
//        /*$select_parts = array();
//        foreach($this->select as $alias => $column){
//            $select_parts[] = $column.' AS '.$alias;
//        }
//        return implode(', ', $select_parts);*/
//    }
    
//    public function generate_update(){
//        $update = array();
//        foreach($this->set as $k => $v){
//            $update[] = $k.' = \''.$v.'\'';
//        }
//        
//        return ' SET '.implode(', ', $update);
//    }
    
//    public function generate_insert(){
//        $target = array();
//        $values = array();
//        foreach($this->set as $k => $v){
//            $this->params[] = $v;
//            $target[] = $k;
//            $values[] = '?';
//        }
//        
//        return '('.implode(', ', $target).') VALUES ('.implode(', ', $values).')';
//    }
    
//    public function generate_where() {
//        
//        if(count($this->where) == 0)
//            return '';
//        
//        $set = new query_where_set($this->where);
//        
//        $cond = $set->generate();
//        $this->params = $set->get_params();
//        return ' WHERE '.$cond;
//        
//        /*$where_parts = array();
//        foreach($this->where as $k => $v){
//            if(is_array($v)){
//                $n = count($v);
//                foreach($v as $p){
//                    $this->params[] = $p;
//                }
//            }
//            else{
//                $n = 1;
//                $this->params[] = $v;
//            }
//            $where_parts[] = $this->generate_unparameterized_expression($k, $n);
//        }
//        return ' WHERE '.implode(' AND ', $where_parts);*/
//    }
    
    
    
//    public function generate_order_by(){
//        if(count($this->order) == 0) return '';
//        $order_parts = array();
//        foreach($this->order as $column => $direction){
//            $order_parts[] = $column.' '.$direction;
//        }
//        return ' ORDER BY '.implode(', ', $order_parts);
//    }
    
//    public function generate_limit(){
//        if(!is_numeric($this->limit)) return '';
//        
//        if($this->offset && $this->limit)
//            return ' LIMIT '.$this->offset.', '.$this->limit;
//        
//        return ' LIMIT '.$this->limit;
//    }
    
    public function generate_group_by(){
        if(count($this->group) == 0) return '';
        return ' GROUP BY '.implode(', ', $this->group);
    }
}
