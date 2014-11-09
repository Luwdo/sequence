<?php
namespace Sequence;
/**
 * Represents a query which yields data, such as a SELECT or SHOW, etc.
 * 
 * @author luwdo
 */
abstract class DataYieldingQuery extends FilterableQuery{
	public function __toString() {
		parent::__toString();
	}
	
}
