<?php
class Model_DbTable_Row_Update extends Zend_Db_Table_Row_Abstract
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
	
//	protected function _doInsert()
//	{
//		parent::_doInsert();
//		$this->comiccrypt = substr(strrev(md5($this->comicid)), 0, 16);
//		return $this->_doUpdate();
//	}
}