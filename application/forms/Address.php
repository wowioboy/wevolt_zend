<?php

class Form_Address extends Zend_Form
{
    public function init()
    {
    	$this->addElement('text', 'address', array('label' => 'address:'));
    	$this->addElement('text', 'address2', array('label' => 'address 2:'));
    	$this->addElement('text', 'city', array('label' => 'city:'));
    	$this->addElement('select', 'state', array('label' => 'state:', 'multiOptions' => Wevolt_Form_Data::getStates()));
    	$this->addElement('text', 'zip', array('label' => 'zip:'));
    }
}