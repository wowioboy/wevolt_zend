<?php

class CalendarController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->id = '64223ccf3b0';
        if ($user = $this->_getParam('username')) {
        	$users = new Model_DbTable_Users;
            $this->view->id = $users->getEncryptid($user);
	        $auth = Zend_Auth::getInstance();
	        if ($auth->hasIdentity() && $this->view->id == $auth->getIdentity()->encryptid) {
	        	$this->view->owner = true;
	        }
        }
        $this->view->view = 'month';
        if ($view = $this->_getParam('view')) {
        	if ($view == 'week') {
            	$this->view->view = 'basicWeek';
            } else if ($view == 'day') {
        		$this->view->view = 'basicDay';
            }
       	}
        if (!$date = $this->_getParam('date')) {
        	$date = date('Y-m-d');
        }
        $date = explode('-', $date);
        $this->view->year = $date[0];
        $this->view->month = $date[1]-1;
        $this->view->day = $date[2];
    }

    public function getEventsAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		$events = Wevolt_Factory::table('calendar')->getEvents($this->_getParam('start'), $this->_getParam('end'), $this->_getParam('userid'), $this->_getParam('type'));
        echo json_encode($events);
    }

    public function addAction()
    {
    	$form = new Form_Event();
    	if ($this->getRequest()->isPost() && $form->isValid($this->_getAllParams())) {
    		Wevolt_Factory::table('calendar')->createRow($form->getValues())->save();
    	}
    	$this->view->form = $form;
    }

    public function editAction()
    {
    	if ($id = $this->_getParam('id')) {
	    	$event = Wevolt_Factory::table('calendar')->find($id)->current();
	    	$form = new Form_Event();
			$form->populate($event->toArray());
	    	if ($this->getRequest()->isPost() && $form->isValid($this->_getAllParams())) {
	    		$event->setFromArray($form->getValues())->save();
	    	}
	    	$this->view->form = $form;
    	} else {
    		echo "Hey! Where's the event you're trying to edit?!"; exit;
    	}
    }
    
    public function deleteAction()
    {
    	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if ($id = $this->_getParam('id')) {
	        Wevolt_Factory::table('calendar')->find($id)->current()->delete();
        }
    }
}





