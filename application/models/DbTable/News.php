<?php
class Model_DbTable_News extends Wevolt_Db_Table
{
    protected $_name = 'pf_news';
    
    public function getNews($type = 'news')
    {
    	$select = $this->getAdapter()->select()
    								 ->from($this->_name, array('headline', 'content', 'newstype'))
    								 ->where("newstype = '$type'")
    								 ->where("isactive = '1'")
    								 ->order('createddate desc');
    	return $this->getAdapter()->fetchAll($select);
    }
}