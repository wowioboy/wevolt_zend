<?php
class Wevolt_Plugin_Acl extends Zend_Controller_Plugin_Abstract 
{
	public function preDispatch(Zend_Controller_Request_Abstract $request) 
  	{
  		$acl = Wevolt_Acl::getInstance();
  		$role = $acl->getUserRole();
  		$controller = $request->getControllerName();
  		$action = $request->getActionName();
  		if ($controller != 'auth' && !$acl->isAllowed($role, $controller, $action)) {
			$request->setModuleName('default')
					->setControllerName('auth')
					->setActionName('login');
  		}
	}
}
