<?php
class Wevolt_Acl extends Zend_Acl
{
	static public $_instance = null;
	
	public function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	
	public function __construct()
	{
		# ADD USER TYPES
		$this->addRole(new Zend_Acl_Role('prouser'));
		$this->addRole(new Zend_Acl_Role('user'), 'prouser');
		$this->addRole(new Zend_Acl_Role('guest'), 'user');
		
		# ADD RESOURCES
		$this->add(new Zend_Acl_Resource('error'));
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('calendar'));
		$this->add(new Zend_Acl_Resource('store:index'));
		
		$this->allow();
		$this->deny('guest', 'calendar', 'add');
		$this->deny('guest', 'calendar', 'edit');
		$this->deny('guest', 'store:index');
	}
	
	public function getUserRole()
	{
		$auth = Zend_Auth::getInstance();
  		if ($auth->hasIdentity()) {
  			if ($auth->getIdentity()->isPro) {
  				$role = 'prouser';
  			} else {
  				$role = 'user';
  			}
  		} else {
  			$role = 'guest';
  		}
  		return $role;
	}
}