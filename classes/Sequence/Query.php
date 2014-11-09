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
	 * 
	 * @var QueryPart\Operand
	 */
	public $operand = null;
	
	/**
	 *
	 * @var QueryPart\GroupBySet or QueryPart\GroupByItem
	 */
    public $groupBy = null;
	
	
    public $queryResult = null;
	
	public $stmt = null;
	
	/**
	 * 
	 * @return string
	 */
	public function generateGroupBy(){
		if($this->groupBy != null){
			return "GROUP BY {$this->groupBy}";
		}
		return "";
	}
	
	
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
    public static function sanitize($input) {
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
        else throw new Exception('Query type was not set');
        
    }
  */ 
	
	
	public function from($operand, $alias = null){
		$fromClause = new QueryPart\FromClause();
		$fromClause->operand = $operand;
		$fromClause->alias = $alias;
		
		$newQuery = clone $this;
		$newQuery->fromClause = $fromClause;
		return $newQuery;
	}
	
	
}
