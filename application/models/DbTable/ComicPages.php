<?php

class Model_DbTable_ComicPages extends Wevolt_Db_Table
{
    protected $_name = 'comic_pages';
    protected $_rowClass = 'Model_DbTable_Row_ComicPage';
    protected $_referenceMap = array(
    	'Comic' => array(
    		'columns'       => 'ComicID',
    		'refTableClass' => 'Model_DbTable_Comics',
    		'refColumns'    => 'comiccrypt'
    	)
    );
    
    public function search($page = 1, $limit = 20, $sortCol = 'title', $sortDir = 'asc', $search = null)
    {
    	if (is_null($page)) {
    		$page = 1;
    	}
    	if (is_null($limit)) {
    		$limit = 20;
    	}
    	$offset = $page * $limit - $limit;
    	$select = $this->getAdapter()->select()
    								 ->from($this->_name, array('title', 'thumb'))
    								 ->where("title != ''");
    	if (isset($search)) {
			$search = str_replace(' ', '', $search);
			$search = str_split($search);
			$search = implode('%', $search);
			$select->where("title like '%$search%'");
		}
    	$count = $this->doCount($select);
    	$pages = ceil($count / $limit);
    	if (is_null($sortCol)) {
    		$sortCol = 'title';
    	}
    	if (is_null($sortDir)) {
    			$sortDir = 'asc';
    	}
    	$select->limit($limit, $offset)
    		   ->order("$sortCol $sortDir");
    	$results = $this->getAdapter()->fetchAll($select);
    	$result = array('rows' => $results, 
    					'pages' => $pages,
    					'count' => $count,
    					'page' => $page);
    	return $result;
    }
}