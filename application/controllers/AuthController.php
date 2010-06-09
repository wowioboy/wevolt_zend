<?php

class AuthController extends Zend_Controller_Action
{
	public function loginAction()
    {
	    $loginForm = new Form_Login;
        if ($this->getRequest()->isPost() && $loginForm->isValid($this->_getAllParams())) {
        	$users = new Model_DbTable_Users;
            $adapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'users', 'email', 'password', 'md5(concat(md5(?), salt))');
            $adapter->setIdentity($loginForm->getValue('email'));
            $adapter->setCredential($loginForm->getValue('password'));
            $result = Zend_Auth::getInstance()->authenticate($adapter);
            if ($result->isValid()) {
            	$storage = Zend_Auth::getInstance()->getStorage();
            	$user = $adapter->getResultRowObject(null, array('salt'));
            	$subscriptions = new Model_DbTable_Subscriptions;
            	$user->isPro = $subscriptions->getPro($user->encryptid);
   				$storage->write($user);
   				$this->_redirect('/');
            } else {
            	echo 'That is the incorrect login info.';
            }
        }
        $this->view->loginForm = $loginForm;
    }
    
    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_redirect('/');
    }
}

