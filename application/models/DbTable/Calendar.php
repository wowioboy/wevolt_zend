<?php

class Model_DbTable_Calendar extends Zend_Db_Table_Abstract
{
    protected $_name = 'calendar';
    
    public function getEvents($start, $end, $userId, $type = 'all')
    {
    	$start = date('Y-m-d H:i:s', $start);
		$end = date('Y-m-d H:i:s', $end);
		$query = "select * 
				  from calendar 
				  where user_id = '$userId' 
				  and deleted = '0'";
		if ($type != 'all') {
			$query .= " and type = '$type'";
		}
		$query .= " and ((start >= '$start' and start <= '$end')
		  			or (frequency = 'daily') 
		  			or (frequency = 'weekly')
		  			or (frequency = 'monthly' and (day(start) >= day('$start') and day(start) <= day('$end'))))";
		return $this->getAdapter()->fetchAll($query);	
    }
}