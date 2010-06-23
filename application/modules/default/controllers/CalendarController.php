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
        $calendar = new Model_DbTable_Calendar;
		$events = $calendar->getEvents($this->_getParam('start'), $this->_getParam('end'), $this->_getParam('userid'), $this->_getParam('type'));
        echo json_encode($events);
    }

    public function addAction()
    {
    	$this->_helper->layout->disableLayout();
    	$form = new Form_Event;
    	if ($this->getRequest()->isPost() && $form->isValid($this->_getAllParams())) {
    		$calendar = new Model_DbTable_Calendar;
    		$values = $form->getValues();
    		$values['start'] = $values['start_date'] . ' ' . $values['start_time'];
    		$values['end'] = $values['end_date'] . ' ' . $values['end_time'];
    		$values['thumb'] = '/uploads/' . $values['thumb'];
    		$location = $values['location'];
    		unset($values['location']);
    		$values += $location;
    		$event = $calendar->createRow($values);
    		$event->user_id = Zend_Auth::getInstance()->getIdentity()->encryptid;
    		$event->save();
    		$this->view->saved = true;
    	} else {
	    	$this->view->form = $form;
    	}
    }

    public function editAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	$calendar = Wevolt_Factory::table('calendar');
    	var_dump($calendar);
    }
    
    public function deleteAction()
    {
    	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if ($id = $this->_getParam('id')) {
        	$calendar = new Model_DbTable_Calendar;
        	$event = $calendar->find($id)->current();
        	$event->delete();
        }
    }
}





