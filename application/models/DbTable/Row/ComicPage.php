<?php
class Model_DbTable_Row_ComicPage extends Zend_Db_Table_Row_Abstract
{
	public function __get($name)
	{
		switch ($name) {
			case 'comic':
				return $this->findParentModel_DbTable_Comics();
				break;
			default:
				return parent::__get($name);
		}
	}
	
	protected function _doInsert()
	{
		parent::_doInsert();
		$this->encryptpageid = substr(strrev(md5($this->id)), 0, 16);
		return $this->_doUpdate();
	}
}