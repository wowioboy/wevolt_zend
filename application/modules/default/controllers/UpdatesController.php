<?php

class UpdatesController extends Zend_Controller_Action
{
    public function indexAction()
    {
    }
    
    public function subTabAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->view->filter = $this->_getParam('filter');
    }
    
    public function viewAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->view->type = $this->_getParam('type');
    	$this->view->filter = $this->_getParam('filter');
    	$this->view->updates = Wevolt_Factory::table('updates')->getUpdates($this->view->type, $this->view->filter, @Zend_Auth::getInstance()->getIdentity()->encryptid);
    }
    
    public function followAction()
    {
    	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        echo Wevolt_Factory::table('UsersUpdates')->toggleSubscription($this->_getParam('id'), $this->_getParam('type'));
    }
    
    public function expandedAction()
    {
    	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		$results = Wevolt_Factory::table('updates')->getExpansion($this->_getParam('id'), $this->_getParam('type'), $this->_getParam('update'));
		echo json_encode($results);
    }
    
	public function calendarViewAction()
    {
    	$this->_helper->layout->disableLayout();
		$this->view->updates = Wevolt_Factory::table('calendar')->getUpdates(Zend_Auth::getInstance()->getIdentity()->encryptid, $this->_getParam('range'));
    }
}