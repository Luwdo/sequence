<?php
namespace Sequence\QueryPart;
/**
 * A set of updateItems in an update query
 * @author luwdo
 */
class SetSet {
	public $setItems = null;
	
	public function __toString() {
		return implode(', ', $this->setItems);
	}
}
