<?php
/**
 * Description of delete_query
 *
 * @author luwdo
 */
class delete_query extends filterable_query{
	
	
	public function generate_query(){
        $this->params = array();
        return 'DELETE FROM '.$this->table.$this->generate_where().$this->generate_group_by().$this->generate_order_by().$this->generate_limit();
    }
}
