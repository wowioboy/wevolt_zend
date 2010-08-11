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
    	$sortCol = $this->_getParam('sort_col');
    	$sortDir = $this->_getParam('sort_dir');
		
    	if ($content = $this->_getParam('content')) {
	    	$results = Wevolt_Factory::table($content)->search($page, $limit, $sortCol, $sortDir, $search);
	    	echo json_encode($results);
    	}
    }
    
}