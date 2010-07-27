<?php

class AuthController extends Zend_Controller_Action
{
	public function loginAction()
    {
        if ($this->getRequest()->isPost()) {
    		$this->_helper->layout->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();
        	$users = new Model_DbTable_Users;
            $adapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'users', 'email', 'password', 'md5(concat(md5(?), salt))');
            $adapter->setIdentity($this->_getParam('email'));
            $adapter->setCredential($this->_getParam('password'));
            $result = Zend_Auth::getInstance()->authenticate($adapter);
            if ($result->isValid()) {
            	$storage = Zend_Auth::getInstance()->getStorage();
            	$user = $adapter->getResultRowObject(null, array('salt'));
            	$subscriptions = new Model_DbTable_Subscriptions;
            	$user->isPro = $subscriptions->getPro($user->encryptid);
   				$storage->write($user);
   				echo 1;
   				return;
            } 
        	echo 0;
        } elseif ($this->_getParam('iframe') == 1) {
    		$this->_helper->layout->disableLayout();
    	}
    }
    
    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_redirect('/');
    }
}

