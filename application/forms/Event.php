<?php

class Form_Event extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->addElement('select', 'type', array(
                'required' => true,
        		'multiOptions' => array('event' => 'event',
        							    'reminder' => 'reminder',
        								'todo' => 'to do',
        								'promotion' => 'promotion')
        ));
    	$this->addElement('text', 'title', array(
                'label' => 'Title:',
                'required' => true
        ));
        $this->addElement('textarea', 'description', array('label' => 'Description:', 'cols' => '25', 'rows' => '10'));
    	$this->addElement('text', 'start_date', array('label' => 'Start:'));
        $this->addElement('select', 'start_time', array('multiOptions' => Wevolt_Form_Data::getTimes()));
        $this->addDisplayGroup(array('start_date', 'start_time'), 'start');
        $this->addElement('text', 'end_date', array('label' => 'End:'));
        $this->addElement('select', 'end_time', array('multiOptions' => Wevolt_Form_Data::getTimes()));
        $this->addDisplayGroup(array('end_date', 'end_time'), 'end');
        $this->addElement('text', 'address', array('label' => 'address:'));
    	$this->addElement('text', 'address2', array('label' => 'address 2:'));
    	$this->addElement('text', 'city', array('label' => 'city:'));
    	$this->addElement('select', 'state', array('label' => 'state:', 'multiOptions' => Wevolt_Form_Data::getStates()));
    	$this->addElement('text', 'zip', array('label' => 'zip:'));
        $this->addElement('file', 'thumb', array('label' => 'Thumbnail:', 'destination' => 'uploads'));
        $this->addElement('select', 'frequency', array('multiOptions' => Wevolt_Form_Data::getFrequencies()));
        $this->addElement('text', 'interval');
        $this->addElement('select', 'week_day', array())
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));
    }
}