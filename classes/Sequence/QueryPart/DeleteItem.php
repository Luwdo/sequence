<?php
namespace Sequence\QueryPart;
/**
 * Description of DeleteItem
 *
 * @author luwdo
 */
class DeleteItem {
	public $table = null;
	public function __toString() {
		return $this->table;
	}
}
