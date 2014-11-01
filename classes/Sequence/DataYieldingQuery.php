<?php
namespace Sequence;
/**
 * Represents a query which yields data, such as a SELECT or SHOW, etc.
 * 
 * @author luwdo
 */
class DataYieldingQuery extends FilterableQuery{
	public $class = null;
}
