<?php
class Model_DbTable_UsersUpdates extends Wevolt_Db_Table
{
	protected $_name = 'users_updates';
	
	public function toggleSubscription($id, $subject)
    {
    	if (Zend_Auth::getInstance()->hasIdentity()) {
	    	$userid = Zend_Auth::getInstance()->getIdentity()->encryptid;
    	}
    	$count = $this->doCount("user_id = '$userid' and update_id = '$id' and subject = '$subject'");
    	if ($count) {
    		$this->unsubscribe($userid, $id, $subject);
    		return 2;
    	} else {
    		$this->subscribe($userid, $id, $subject);
    		return 1;
    	}
    }
    
    public function subscribe($userid, $id, $subject)
    {
    	$this->insert(array('user_id' => $userid, 'update_id' => $id, 'subject' => $subject));
    }
    
    public function unsubscribe($userid, $id, $subject)
    {
    	$this->delete("user_id = '$userid' and update_id = '$id' and subject = '$subject'");
    }
}