<?php

class CalendarController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->id = '64223ccf3b0';
        if ($user = $this->_getParam('username')) {
        	$users = new Model_DbTable_Users;
            $this->view->id = $users->getEncryptid($user);
        }
        $this->view->view = 'month';
        if ($view = $this->_getParam('view')) {
        	if ($view == 'week') {
            	$this->view->view = 'agendaWeek';
            } else if ($view == 'day') {
        		$this->view->view = 'agendaDay';
            }
       	}
        if (!$date = $this->_getParam('date')) {
        	$date = date('Y-m-d');
        }
        $date = explode('-', $date);
        $this->view->year = $date[0];
        $this->view->month = $date[1]-1;
        $this->view->day = $date[2];
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity() && $this->view->id == $auth->getIdentity()->encryptid) {
        	$this->view->owner = true;
        }
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
        // action body
    }

    public function editAction()
    {
        // action body
    }
}





