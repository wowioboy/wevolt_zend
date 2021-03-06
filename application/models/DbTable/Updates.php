<?php
class Model_DbTable_Updates extends Wevolt_Db_Table
{
    protected $_name = 'updates';
    protected $_rowClass = 'Model_DbTable_Row_Update';
    protected $_referenceMap = array(
    	'User' => array(
    		'columns'       => 'userid',
    		'refTableClass' => 'Model_DbTable_Users',
    		'refColumns'    => 'encryptid'
    	)
    );
    
    public function getUpdates($type = 'project', $filter = null, $userid = null)
    {
    	$select = $this->getAdapter()->select();
    	$select->from(array('u' => 'updates'), array('u.link', 
    												 'u.id', 
    												 'action'  => 'u.actiontype as action', 
    												 'subject' => 'u.actionsection as subject',
    												 'date'    => 'ifnull(u.live_date, u.date)',
    												 'title'   => 'u.content_title'));
    	switch ($type) {
			case 'project':
				$select->joinLeft(array('p' => 'projects'), 'p.projectid = u.content_id', array('subject_id' => 'u.content_id', 'name' => 'p.title', 'p.thumb'))
					   ->joinLeft(array('uu' => 'users_updates'), 'uu.update_id = u.content_id', array())
					   ->where('u.content_id is not null')
					   ->where('p.title is not null')
					   ->where("u.actionsection = 'page' or u.actionsection = 'series' or u.actionsection = 'strip'");
				break;
			case 'user':
				$select->joinLeft(array('us' => 'users'), 'us.encryptid = u.userid', array('subject_id' => 'u.userid', 'name' => 'us.username', 'thumb' => 'us.avatar'))
					   ->joinLeft(array('uu' => 'users_updates'), 'uu.update_id = u.userid', array())
					   ->where('u.content_id is null')
					   ->where('us.username is not null')
					   ->where("u.actionsection = 'window' or u.actionsection = 'excite' or u.actionsection = 'promotion'");
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
    	$select->columns(array('following' => 'uu.subject'))
    		   ->where('u.link is not null')
    		   ->where('u.live_date is null or u.live_date < now()')
    		   ->group('name')
    		   ->order('u.date desc')
    		   ->limit(25);
    	if (!is_null($userid)) {
    		$select->where("u.userid != '$userid'");
    	}
    	return $this->getAdapter()->fetchAll($select);
    }
    
    public function getExpansion($id, $type, $updateid)
    {
    	$select = $this->getAdapter()->select();
		$select->from(array('u' => 'updates'), array('action' => 'u.actiontype',
													 'subject' => 'u.actionsection',
													 'date' => 'ifnull(u.live_date, u.date)',
													 'title' => 'u.content_title',
													 'u.link'))
			   ->where('u.link is not null')
			   ->where('u.live_date is null or u.live_date < now()')
			   ->where("u.id != '$updateid'")
			   ->group(array('u.actiontype', 'u.actionsection'))
			   ->order('u.date desc')
			   ->limit(25);
		switch ($type) {
			case 'project':
				$select->where("u.content_id = '$id'");
				break;
			case 'user':
				$select->where('u.content_id is null')
					   ->where("u.userid = '$id'");
				break;
			default:
		}
		return $this->getAdapter()->fetchAll($select);
    }
}