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
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('user'), 'guest');
		$this->addRole(new Zend_Acl_Role('prouser'), 'user');
		$this->addRole(new Zend_Acl_Role('admin'));
		
		# ADD RESOURCES
		$this->add(new Zend_Acl_Resource('default:error'));
		$this->add(new Zend_Acl_Resource('default:index'));
		$this->add(new Zend_Acl_Resource('default:calendar'));
		$this->add(new Zend_Acl_Resource('default:faqs'));
		$this->add(new Zend_Acl_Resource('default:search'));
		$this->add(new Zend_Acl_Resource('default:auth'));
//		$this->add(new Zend_Acl_Resource('store:index'));
		
		# start with no privelages
		$this->deny();
		
		# admin can access everything
		$this->allow('admin');
		
		# guest has most of the basic access
		$this->allow('guest', 'default:auth');
		$this->allow('guest', 'default:index');
		$this->allow('guest', 'default:faqs');
	}
}