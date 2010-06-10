<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	public function __construct($application)
	{
		parent::__construct($application);
		
		# REGISTER ADDITIONAL NAMESPACES
		Zend_Loader_Autoloader::getInstance()->registerNamespace('Wevolt_');
		$front = Zend_Controller_Front::getInstance();
		
		# CUSTOM ROUTES
		$router = $front->getRouter();
		$route = new Zend_Controller_Router_Route_Static('login', array('controller' => 'auth', 'action' => 'login'));
		$router->addRoute('login', $route);
		$route = new Zend_Controller_Router_Route_Static('logout', array('controller' => 'auth', 'action' => 'logout'));
		$router->addRoute('logout', $route);
		
		# PLUGINS
		$front->registerPlugin(new Wevolt_Plugin_Acl());
	}
}