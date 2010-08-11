<?php

class Sandbox_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction()
    {
//    	$comics = new Comics();
//    	var_dump($comics);
		$user = Wevolt_Factory::table('users')->getUser('matteblack');
		var_dump($user->events);
//		var_dump();
		
//    	var_dump($user);
//    	var_dump($user);
        // action body
    }
}