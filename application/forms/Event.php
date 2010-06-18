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
        
        $subForm = new Form_Address;
        $this->addSubForm($subForm, 'location');
        
        $this->addElement('file', 'thumb', array('label' => 'Thumbnail:', 'destination' => 'uploads'));
        
        $this->addElement('select', 'frequency', array(
        	'multiOptions' => array('' => 'one time', 
        							'daily' => 'daily', 
        							'weekly' => 'weekly', 
        							'monthly' => 'monthly')
        ));
        
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));
    }
}