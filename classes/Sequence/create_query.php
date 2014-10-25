<?php
/**
 * Description of create_query
 *
 * @author luwdo
 */
class create_query extends executable_query {
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
}
