<?php
namespace Sequence\QueryPart;
/**
 * Description of SetSet
 *
 * @author luwdo
 */
class SetSet {
	public $setItems = null;
	
	public function __toString() {
		return implode(', ', $this->setItems);
	}
}
