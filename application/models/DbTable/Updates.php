<?php

class Model_DbTable_Updates extends Zend_Db_Table_Abstract
{
    protected $_name = 'updates';
    
    public function getUpdates($type = 'project', $filter = null)
    {
    	$userid = @Zend_Auth::getInstance()->getIdentity()->encryptid;
    	$select = $this->getAdapter()->select();
    	$select->from(array('u' => 'updates'), array('u.link', 
    												 'u.id', 
    												 'count' => 'count(distinct u.actiontype, u.actionsection)', 
    												 'action' => 'u.actiontype as action', 
    												 'subject' => 'u.actionsection as subject'));
    	switch ($type) {
			case 'project':
				$select->joinLeft(array('p' => 'projects'), 'p.projectid = u.content_id', array('subject_id' => 'u.content_id', 'name' => 'p.title', 'p.thumb'))
					   ->joinLeft(array('uu' => 'users_updates'), 'uu.update_id = u.content_id', array())
					   ->where('u.content_id is not null')
					   ->where('p.title is not null');
				break;
			case 'user':
				$select->joinLeft(array('us' => 'users'), 'us.encryptid = u.userid', array('subject_id' => 'u.userid', 'name' => 'us.username', 'thumb' => 'us.avatar'))
					   ->joinLeft(array('uu' => 'users_updates'), 'uu.update_id = u.userid', array())
					   ->where('u.content_id is null')
					   ->where('us.username is not null');
		}
		
		switch ($filter) {
			case 'friends':
				$select->joinLeft(array('f' => 'friends'), "(if(f.userid = '$userid', u.userid = f.friendid, u.userid = f.userid))", array())
					   ->where("f.userid = '$userid' or f.friendid = '$userid'")
					   ->where("f.accepted = '1'");
				break;
			case 'my':
				$select->where('uu.user_id is not null');
		}
		
    	$select->columns(array('following' => 'ifnull(uu.subject, null)'));
    	$select->where("u.userid != '$userid'");
    	$select->where('u.link is not null');
    	$select->group('subject_id');
		$select->order('u.date desc');
    	$select->limit(25);
    	
//    	echo $select; exit;
    	
		$results = $this->fetchAll($select);
		var_dump($results);
    }
}