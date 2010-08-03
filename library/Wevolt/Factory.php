<?php
class Wevolt_Factory
{
	static public function table($tableName)
	{
		$class = 'Model_DbTable_' . ucfirst($tableName);
		if (class_exists($class)) {
			return new $class;
		} else {
			return new Wevolt_Db_Table(array('name' => $tableName));
		}
	}
}