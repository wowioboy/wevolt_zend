<?php

class UpdatesController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // action body
    }
    
    public function viewAction()
    {
    	$filter = $this->_getParam('filter');
    	$type = $this->_getParam('type');
    	
    	$table = Wevolt_Factory::table('updates');
    	$table->getUpdates();
    }
}