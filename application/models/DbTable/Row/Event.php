<?php
class Model_DbTable_Row_Event extends Zend_Db_Table_Row_Abstract
{
	public function __get($name)
	{
		switch ($name) {
			case 'user':
				return $this->findParentModel_DbTable_Users();
			default:
				return parent::__get($name);
		}	
	}
	
	protected function _doInsert()
	{
		parent::_doInsert();
		$this->encrypt_id = substr(strrev(md5($this->id)), 0, 16);
		return $this->_doUpdate();
	}
}