<?php
class Form_Settings extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement('file', 'avatar', array('destination' => 'uploads'));
	}
}