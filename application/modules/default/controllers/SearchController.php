<?php
class SearchController extends Zend_Controller_Action
{
    public function indexAction()
    {
    }
    
    public function getResultsAction()
    {
    	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
    	$page = $this->_getParam('page');
    	$limit = $this->_getParam('limit');
    	$search = $this->_getParam('search');
    	$sortCol = $this->_getParam('sidx');
    	$sortDir = $this->_getParam('sord');
    	
		
    	$results = Wevolt_Factory::table('comics')->getComics($page, $limit, $sortCol, $sortDir, $search);
    	echo json_encode($results);
    }
}