<?php

class Form_Event extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->addElement('select', 'type', array('required' => true, 'multiOptions' => Wevolt_Form_Data::getEventTypes()));
    	$this->addElement('text', 'title', array('required' => true));
        $this->addElement('textarea', 'description', array('cols' => '25', 'rows' => '5'));
    	$this->addElement('text', 'location');
    	
        $this->addElement('text', 'address', array('label' => 'address:'));
    	$this->addElement('text', 'address2', array('label' => 'address 2:'));
    	$this->addElement('text', 'city', array('label' => 'city:'));
    	$this->addElement('select', 'state', array('label' => 'state:', 'multiOptions' => Wevolt_Form_Data::getStates()));
    	$this->addElement('text', 'zip', array('label' => 'zip:'));
    	
    	$date = new DateTime(date('Y-m-d H:i:s'));
    	$this->addElement('text', 'start_date', array('value' => $date->format('Y-m-d')));
        $this->addElement('select', 'start_time', array('value' => $date->format('H:00:00'), 
        												'multiOptions' => Wevolt_Form_Data::getTimes()));
        $date->modify('+2 hour');
        $this->addElement('text', 'end_date', array('value' => $date->format('Y-m-d')));
        $this->addElement('select', 'end_time', array('value' => $date->format('H:00:00'),
        											  'multiOptions' => Wevolt_Form_Data::getTimes()));
        
        $this->addElement('file', 'thumb', array('destination' => 'uploads'));
        
        $this->addElement('select', 'frequency', array('multiOptions' => Wevolt_Form_Data::getFrequencies()));
        $this->addElement('text', 'interval', array('value' => 1));
        $this->addElement('checkbox', 'custom');
        $this->addElement('select', 'week_number', array('multiOptions' => Wevolt_Form_Data::getWeekNumbers()));
        $this->addElement('multicheckbox', 'week_day', array('multiOptions' => Wevolt_Form_Data::getWeekDays()));
        $this->addElement('submit', 'submit');
        $this->setElementDecorators(array('ViewHelper', 'Errors'));
    }
    
    public function getValues()
    {
    	$values = parent::getValues();
    	$values['start'] = $values['start_date'] . ' ' . $values['start_time'];
    	$values['end'] = $values['end_date'] . ' ' . $values['end_time'];
    	$values['week_day'] = implode(',', (array) $values['week_day']);
    	return $values;
    }
    
    public function populate($values)
    {
    	$startTime = explode(' ', $values['start']);
    	$endTime = explode(' ', $values['end']);
    	$values['start_date'] = $startTime[0];
    	$values['start_time'] = $startTime[1];
    	$values['end_date'] = $endTime[0];
    	$values['end_time'] = $endTime[1];
    	$values['week_day'] = explode(',', $values['week_day']);
    	parent::populate($values);
    }
}