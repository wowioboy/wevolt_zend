<?php
class Wevolt_Db_Table extends Zend_Db_Table_Abstract
{
	public function doCount($where = null)
	{
		if ($where instanceof Zend_Db_Select) {
			$select = $where;
			$select->reset('columns');
			$select->columns(array("count(1)"));
		} else {
			$select = $this->getAdapter()->select()
					                     ->from($this->_name, array('count(1)'));
			if (isset($where)) {
				$select->where($where);
			}
		}
		return $this->getAdapter()->fetchOne($select);
	}
}