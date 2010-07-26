<?php
class Model_DbTable_Row_Event extends Zend_Db_Table_Row_Abstract
{
	protected function _doInsert()
	{
		parent::_doInsert();
		$this->encrypt_id = substr(strrev(md5($this->id)), 0, 16);
		return $this->_doUpdate();
	}
}