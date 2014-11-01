<?php
namespace Sequence;
/**
 * Base class of queries within Sequence. 
 * 
 * @property int affected_rows Number of affected rows
 * @property int errno Error number
 * @property string[] error_list A list of errors (**TODO: Yeah?**)
 * @property string error String error message
 * @property int field_count Number of fields in result set
 * @property mixed insert_id Result of ID generation for the inserted row.
 * @property int num_rows Number of rows in result set
 * @property int param_count Number of parameters provided to bound query
 * @property mixed sqlstate Whats this? **TODO**
 * @property string table Name of the table or view being selected (Alias of 'from')
 * 
 */
class Query {
    /**
	 * The table or view which is being selected from.
	 * 
	 * @var type 
	 */
	public $from = null;
    public $params = array();
    public $group = array();
    public $type = null;
    public $result = null;
	
    //public $order = array();
    //public $set = array();
    //public $limit = null;
    //public $offset = null;
    //public $class = null;
    //public $select = '*'; // if array assuming that you are aliasing it?
    //public $where = array();
    //public $result_type = null;
	
	public $stmt = null;
	
	/**
	 * Allows you to specialize the given query into the type of query
	 * you are calling specialize() from.
	 * 
	 * @param Query $query Must be a Sequence query object.
	 */
	public static function specialize(Query $query)
	{
		$class = get_called_class();
		$instance = new $class();
		
		foreach ($query as $k => $v) {
			$instance->$k = $v;
		}
		
		return $instance;
	}
	
	/**
	 * Retrieve the value of a semi-protected or generated field.
	 * 
	 * @param string $name Name of the field to retrieve.
	 * @return null
	 */
	public function __get($name) {
		
		// Make the contents of 'from' available as table.
		
		if ($name == 'table')
			return $this->from;
		
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
    
	/**
	 * Convert this object into a string.
	 * Calls query_string() to determine its value.
	 * 
	 * @return string 
	 */
    public function __toString() {
            return $this->queryString();
    }
    
    //Object Manipulation
    
	/**
	 * Begin a new SELECT operation against this query.
	 * 
	 * @param string $select The fields to select in this new SELECT query.
	 * @return \select_query
	 */
    public function select($select = null) {
		$static = !(isset($this) && get_class($this) == __CLASS__);
		
		if ($static)
			return new SelectQuery ();
		
		return SelectQuery::specialize($this);
    }
	
	/**
	 * @deprecated 
	 */
    public static function newSelect($select = null){
        return new SelectQuery();
    }
    
	/**
	 * Begin a new UPDATE operation against this query.
	 * 
	 * @return \update_query
	 */
    public function update() {
		$static = !(isset($this) && get_class($this) == __CLASS__);
		
		if ($static)
			return new UpdateQuery ();
		
		return UpdateQuery::specialize($this);
    }
	
	/**
	 * @deprecated 
	 */
    public static function newUpdate(){
		return new UpdateQuery();
    }
	
    //------
    /**
	 * Begin a new INSERT operation against this query.
	 * 
	 * @return \insert_query
	 */
    public function insert(){
		$static = !(isset($this) && get_class($this) == __CLASS__);
		
		if ($static)
			return new InsertQuery ();
		
		return InsertQuery::specialize($this);
    }
	
	/**
	 * @deprecated
	 */
    public static function newInsert() {
		return new InsertQuery();
    }
	
	/**
	 * Begin a new DELETE operation against this query.
	 * 
	 * @return \delete_query
	 */
    public function delete() {
		$static = !(isset($this) && get_class($this) == __CLASS__);
		
		if ($static)
			return new DeleteQuery ();
		
		return DeleteQuery::specialize($this);
    }
	
	/**
	 * @deprecated 
	 */
    public static function newDelete(){
        $query = new Query();
        $query->type = self::DELETE;
        return $query;
    }
	
    /**
	 * Set the table or view which this query is pulling from.
	 * Alias of from().
	 * 
	 * @param string $table
	 * @return \query
	 */
    public function table($table){
		return $this->from($table);
    }
	
	/**
	 * Set the table or view which this query is pulling from.
	 * @param string $tableOrViewName Name of the table or view
	 * @return \query
	 */
	public function from($tableOrViewName) {
		$this->table = '`'.$tableOrViewName.'`';
		return $this;
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
	 * Declare what content needs to be set within this query.
	 * 
	 * @param array $values An associative array of field name => value.
	 * @return \query The revised query
	 * @throws Exception when invalid $values are provided or $values is empty
	 */
    public function set($values) {
        if(!is_array($values))
            throw new Exception('Set values must be an array');
		
        if(count($values) == 0)
            throw new Exception('Set values must not be an empty array');
		
        $this->set = array_merge($this->set, $values);
		
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
	 * Declare that the query should be grouped by the given fields, in addition to what the
	 * query is currently grouped by.
	 * 
	 * @param mixed $mixed Can be string field name or an array of field names.
	 * @return \query The revised query
	 * @throws Exception $mixed is an empty array
	 */
    public function groupBy($mixed) {
        if(!is_array($mixed)) {
			$this->group[] = $mixed;
			return $this;
		}
		
        if (count($mixed) == 0)
            throw new Exception('Group by conditions must not be an empty array');
		
        $this->group = array_merge($this->group, $mixed);
		
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
	 * @deprecated 
	 * @return \query
	 */
    public function singleOrNull() {
		throw new Exception("Obsolete.");
    }
    
	/**
	 * Alias for model().
	 * 
	 * @param string $class Name of the class to use
	 * @return \query The revised query.
	 */
    public function resultClass($class) {
		return $this->model($class);
    }
	
	/**
	 * Set the name of the class to inflate result rows into.
	 * Class must accept one paramter to its constructor: an
	 * associative array of the row data. It is responsible for
	 * integrating this data into the new instance.
	 * 
	 * @param string $class Name of the class to use
	 * @return \query The revised query.
	 */
	public function model($class) {
        $this->class = $class;
        return $this;	
	}
    
	/**
	 * Return the amount of rows within the result set.
	 * @return int The amount of rows
	 */
    public function count() {
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
    
	/**
	 * Execute the query.
	 * 
	 * @return null
	 * @throws Exception
	 */
    public function run() {
        $query = $this->generate_query();
        
        $mysqli_stmt = core::db()->prepare($query);
        
        if(!$mysqli_stmt) {
            throw new Exception('Query Syntax Error : '.$query);
        }
		
        if(count($this->params) > 0) {
            $params = $this->buildReferencedParameterBindings();
            call_user_func_array(array($mysqli_stmt, 'bind_param'), $params);
        }
        
        if($mysqli_stmt->execute()) {
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
        } else {
            throw new Exception('Query failed Error : '.$mysqli_stmt->error );
        }
		
        if($this->result_type == self::SINGLE_OR_NULL) {
            if(count($this->result) > 1 || count($this->result) == 0) return null;
            return $this->result[0];
        }
        
        return $this->result;
    }
    
    public function buildReferencedParameterBindings() {
        $params = array();
        $types = $this->buildParameterBindingTypes();
        $params[] = &$types;
		
        foreach($this->params as $k => $v) {
            $params[] = &$this->params[$k];
        }
        return $params;
    }
    
    public function buildParameterBindingTypes() {
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
    
    /**
	 * Convenience function to sanitize an input so that is escaped according to the
	 * current SQL engine.
	 * 
	 * @param string $input The content to escape
	 * @return string The escaped content
	 */
    public static function sanatize($input) {
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
	
	/**
	 * Generate the SQL query string.
	 * @return string
	 */
    public function queryString(){
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
    
	/**
	 * Generate a GROUP BY clause
	 * @return string
	 */
    public function generateGroupBy() {
        if(count($this->group) == 0) return '';
        return ' GROUP BY '.implode(', ', $this->group);
    }
}
