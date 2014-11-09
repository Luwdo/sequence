<?php
namespace Sequence\QueryPart;
/**
 * Table selection in a query
 * @author luwdo
 */
class Table extends Part{
	public $name = null;
	
	public function __toString() {
		return "`{$this->name}`";
	}
	
}
