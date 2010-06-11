<?php
class Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
    
    public function getUser($username)
    {
    	return $this->fetchRow(array("username = ?", $username));
    }
    
    public function getEncryptid($username) 
    {
    	return $this->getAdapter()->fetchOne("select encryptid from users where username = '$username'");
    }
}