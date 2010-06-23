<?php
class Wevolt_Factory
{
	static public function table($tableName)
	{
		$class = 'Model_DbTable_' . ucfirst($tableName);
		if (class_exists($class)) {
			return new $class;
		} else {
			return new Zend_Db_Table_Abstract(array('name' => $tableName));
		}
	}
}