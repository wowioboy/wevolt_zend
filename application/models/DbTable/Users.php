<?php
class Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
    protected $_rowClass = 'Model_DbTable_Row_User';
    protected $_dependentTables = array('Model_DbTable_Comics', 'Model_DbTable_Calendar');
    
    public function getUser($username)
    {
    	return $this->fetchRow("username = '$username'");
    }
    
    public function getEncryptid($username) 
    {
    	$select = $this->getAdapter()->select()->from($this->_name, array('encryptid'))
    										   ->where('username = ?', $username);
    	return $this->getAdapter()->fetchOne($select);
    }
}