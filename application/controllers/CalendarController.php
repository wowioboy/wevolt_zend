<?php

class CalendarController extends Zend_Controller_Action
{

    public function init()
    {
    }
    
    public function indexAction()
    {
    	
    }

    public function getEventsAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    	$calendar = new Model_DbTable_Calendar;
    	$events = $calendar->getEvents($this->_getParam('start'), $this->_getParam('end'), $this->_getParam('userid'), $this->_getParam('type'));
    	echo json_encode($events);
    }
}

