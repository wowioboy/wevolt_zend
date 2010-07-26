<?php

class User_SettingsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // action body
    }
    
    public function changePasswordAction()
    {
    	if (isset($this->_getParam('ajax'))) {
	    	$user = Wevolt_Factory::table('Users')->find(Zend_Auth::getInstance()->getIdentity()->userid)->current();
	    	$oldPass = md5(md5($this->_getParam('old_password')) . $user->salt);
	    	$newPass = md5(md5($this->_getParam('new_password')) . $user->salt);
	    	if ($user->password == $oldPass) {
	    		$user->password = $newPass;
	    		echo 1;
	    	} else {
	    		echo 0;
	    	}
    	}
    }
}