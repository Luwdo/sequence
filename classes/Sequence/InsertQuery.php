<?php
namespace Sequence;
/**
 * Description of insert_query
 *
 * @author luwdo
 */
class InsertQuery extends ExecutableQuery{
	public $set = array();
	
	public function generateQuery(){
        $this->params = array();
        return 'INSERT INTO '.$this->table.' '.$this->generateInsert();
    }
	
	public function generateInsert(){
        $target = array();
        $values = array();
        foreach($this->set as $k => $v){
            $this->params[] = $v;
            $target[] = $k;
            $values[] = '?';
        }
        
        return '('.implode(', ', $target).') VALUES ('.implode(', ', $values).')';
    }
	
}
