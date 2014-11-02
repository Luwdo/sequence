<?php
namespace Sequence\QueryPart;
/**
 * Description of Column
 *
 * @author luwdo
 */
class Column {
	public $columnName;
	
	public function __toString() {
		return '`'.$this->columnName.'`';
	}

}
