<?php
class Wevolt_Plugin_Acl extends Zend_Controller_Plugin_Abstract 
{
	public function preDispatch(Zend_Controller_Request_Abstract $request) 
  	{
  		if (Zend_Auth::getInstance()->hasIdentity()) {
  			$role = Zend_Auth::getInstance()->getIdentity()->role;
  		} else {
  			$role = 'guest';
  		}
//  		var_dump($role);
  		$resource = $request->getModuleName() . ':' . $request->getControllerName();
  		$privelage = $request->getActionName();
  		if (!Wevolt_Acl::getInstance()->isAllowed($role, $resource, $privelage)) {
			$request->setModuleName('default')
					->setControllerName('auth')
					->setActionName('login');
  		}
	}
}
