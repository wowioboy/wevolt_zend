<?php
class Model_DbTable_Row_User extends Zend_Db_Table_Row_Abstract
{
	public function __get($name)
	{
		switch ($name) {
			case 'comics':
				return $this->findModel_DbTable_Comics();
			case 'events':
				return $this->findModel_DbTable_Calendar();
			default:
				return parent::__get($name);
		}
	}
	
	protected function _doInsert()
	{
		parent::_doInsert();
		$this->encryptid = substr(strrev(md5($this->id)), 0, 16);
		$this->joindate = date('Y-m-d h:i:s');
		# generate salt and password
//		$this->password = 
		return $this->_doUpdate();
	}
}