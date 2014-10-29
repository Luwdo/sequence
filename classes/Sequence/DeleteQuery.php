<?php
namespace Sequence;
/**
 * Description of delete_query
 *
 * @author luwdo
 */
class DeleteQuery extends FilterableQuery{
	
	
	public function generateQuery(){
        $this->params = array();
        return 'DELETE FROM '.$this->table.$this->generateWhere().$this->generateGroupBy().$this->generateOrderBy().$this->generateLimit();
    }
}
