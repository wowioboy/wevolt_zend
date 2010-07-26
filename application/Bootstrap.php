<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	public function __construct($application)
	{
		parent::__construct($application);

		$front = Zend_Controller_Front::getInstance();
		
		# CUSTOM ROUTES
		$router = $front->getRouter();
		$route = new Zend_Controller_Router_Route_Static('/login', array('controller' => 'auth', 'action' => 'login'));
		$router->addRoute('login', $route);
		$route = new Zend_Controller_Router_Route_Static('/logout', array('controller' => 'auth', 'action' => 'logout'));
		$router->addRoute('logout', $route);
		$route = new Zend_Controller_Router_Route('/user/:username/:controller/:action', array('module' => 'user', 
																							   'controller' => 'index', 
																							   'action' => 'index'));
		$router->addRoute('user', $route);
		$route = new Zend_Controller_Router_Route('/user/:username/calendar', array('module' => 'default', 
																					'controller' => 'calendar', 
																					'action' => 'index'));
		$router->addRoute('user_calendar', $route);
		
		# PLUGINS
		$front->registerPlugin(new Wevolt_Plugin_Acl());
	}
}