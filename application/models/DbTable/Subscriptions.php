<?php
class Model_DbTable_Subscriptions extends Zend_Db_Table_Abstract
{
    protected $_name = 'pf_subscriptions';
    
    public function getPro($userid)
    {
    	$query = "select count(1) from pf_subscriptions s 
				  left join users_settings u 
				  on u.userid = s.userid 
				  where s.status = 'active' 
				  and s.subscriptiontype = 'hosted' 
				  and u.userid = '{$userid}'";
    	return (bool) $this->getAdapter()->fetchOne($query);
    }
}