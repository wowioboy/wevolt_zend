<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	public function __construct($application)
	{
		parent::__construct($application);
		Zend_Loader_Autoloader::getInstance()->registerNamespace('Wevolt_');
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new Wevolt_Plugin_Acl());
	}
}