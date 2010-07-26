<?php
class Wevolt_Db_Table extends Zend_Db_Table_Abstract
{
	public function doCount($where = null, $table = null)
	{
		if (!$table) {
			$table = $this->_name;
		}
		if ($where) {
			$where = "where $where";
		}
		return $this->getAdapter()->fetchOne("select count(1) from $table $where");
	}
}