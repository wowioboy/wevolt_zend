<?php

class Model_DbTable_Calendar extends Zend_Db_Table_Abstract
{
    protected $_name = 'calendar';
    protected $_rowClass = 'Model_DbTable_Row_Event';
    protected $_referenceMap = array(
    	'User' => array(
    		'columns'       => 'user_id',
    		'refTableClass' => 'Model_DbTable_Users',
    		'refColumns'    => 'encryptid'
    	)
    );
    
    public function createRow(array $data = array())
    {
    	$data['user_id'] = Zend_Auth::getInstance()->getIdentity()->encryptid;
    	return parent::createRow($data);
    }
    
    public function getEvents($start, $end, $userId, $type = 'all')
    {
    	$events = array();
    	$start = date('Y-m-d H:i:s', $start);
		$end = date('Y-m-d H:i:s', $end);
    	$startDate = new DateTime($start);
		$endDate = new DateTime($end);
	    $y = $startDate->format('Y');
		$m = $startDate->format('m');
		$endDate->modify('-1 day');
		if ($endDate->format('Y-m-d') != $startDate->format('Y-m-d')) {
			$endDate = new DateTime($end);
			$endDate->modify('-7 day');
			if ($endDate->format('Y-m-d') != $startDate->format('Y-m-d')) {
				$endDate = new DateTime($end);
				$endDate->modify('-1 month');
				if ($endDate->format('m') != $startDate->format('m')) {
					$m++;
					if ($m == 13) {
						$m = 1;
						$y++;
					}	
				}
			}
		}
		$endDate = new DateTime($end);
		$query = "select * 
				  from calendar 
				  where user_id = '$userId' 
				  and deleted = '0' 
				  and start <= '$end'";
		if ($type != 'all') {
			$query .= " and type = '$type'";
		}
		$query .= " and (start >= '$start'
		  			or frequency = 'day' 
		  			or frequency = 'week'
		  			or frequency = 'month')";
		$results = $this->getAdapter()->fetchAll($query);
    	foreach ($results as $event) {
	    	$startDate = new DateTime($event['start']);
			$endDate = new DateTime($event['end']);
			$frequency = $event['frequency'];
			$weekDays = explode(',', $event['week_day']);
			$w = $event['week_number'];
			if (!$interval = $event['interval']) {
				$interval = 1;	
			}
			
			if ($frequency = $event['frequency']) {
				if ($event['custom']) {
					if ($frequency == 'month') {
						$startMonth = $startDate->format('m');
						$im = $m - $startMonth;
						if ($im % $interval == 0) {
					    	$newStart = clone $startDate;
					    	$newEnd = clone $endDate;
							$newStart->setDate($y, $m, $startDate->format('d'));
					    	$newEnd->setDate($y, $m, $endDate->format('d'));
					    	foreach ($weekDays as $dow) {
								$startClone = clone $newStart;
								$endClone = clone $newEnd;
								$date = new DateTime();
								$date->setDate($y, $m, 1);
								$n = $date->format('N');
								$t = $date->format('t');
								if ($n == $dow) {
									$n = 0;
								} elseif ($n < $dow) {
									$n = $dow - $n;
								} elseif ($n > $dow) {
									$n = 7 - $n + $dow;
								}
								$n += 7 * ($w - 1);
								while ($n > $t - 1) {
									$n -= 7;
								}
								$date->modify("+$n day");
								$d = (int) $date->format('d');
								$startDay = $startClone->format('d');
						    	if ($d < $startDay) {
						    		$n = $startDay - $d;
						    		$startClone->modify("-$n day");
						    		$endClone->modify("-$n day");
						    	} elseif ($d > $startDay) {
						    		$n = $d - $startDay;
						    		$startClone->modify("+$n day");
						    		$endClone->modify("+$n day");
						    	}
						    	if ($startClone->format('Y-m-d') >= $startDate->format('Y-m-d')) {
							    	$event['start'] = $startClone->format('Y-m-d H:i:s');
									$event['end'] = $endClone->format('Y-m-d H:i:s');
									$events[] = $event;
						    	}
					    	}
						}
					} elseif ($frequency == 'week') {
						$startDay = $startDate->format('N');
						foreach ($weekDays as $dow) {
							$startClone = clone $startDate;
							$endClone = clone $endDate;
							if ($startDay > $dow) {
								$n = $startDay - $dow;
								$startClone->modify("-$n day");
								$endClone->modify("-$n day");
							} elseif ($startDay < $dow) {
								$n = $dow - $startDay;
								$startClone->modify("+$n day");
								$endClone->modify("+$n day");
							}
							while ($startClone->format('Y-m-d') <= $end) {
								if ($startClone->format('Y-m-d') >= $startDate->format('Y-m-d')) {
									$event['start'] = $startClone->format('Y-m-d H:i:s');
									$event['end'] = $endClone->format('Y-m-d H:i:s');
									$events[] = $event;
								}
								$startClone->modify("+$interval week");
								$endClone->modify("+$interval week");
							}
						}
					}
				} else {
					$startClone = clone $startDate;
					$endClone = clone $endDate;
					while ($startClone->format('Y-m-d') <= $end) {
				    	if ($startClone->format('Y-m-d') >= $startDate->format('Y-m-d')) {
							$event['start'] = $startClone->format('Y-m-d H:i:s');
							$event['end'] = $endClone->format('Y-m-d H:i:s');
							$events[] = $event;
				    	}
						$startClone->modify("+$interval $frequency");
						$endClone->modify("+$interval $frequency");
					}
				}
			} else {
				$events[] = $event;
			}
    	}
    	return $events;
    }
    
    public function getUpdates($userid, $range)
    {
    	$queries = array();
		if ($range == 'today') {
			// get everything for today 
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and curdate() = date(start)";
			// get non custom repeating days 
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and date(start) <= curdate()
						  and frequency = 'day'
						  and custom != '1' 
						  and mod(datediff(now(), start), `interval`) = 0";
			// get non custom repeating weeks 
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and date(start) <= curdate()
						  and frequency = 'week'
						  and custom != '1' 
						  and ceil(mod(datediff(now(), start) / 7, `interval`)) = 0";
			// get non custom repeating months 
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and date(start) <= curdate()
						  and frequency = 'month'
						  and custom != '1' 
						  and mod(period_diff(date_format(now(), '%Y%m'), date_format(start, '%Y%m')), `interval`) = 0 
						  and day(start) = day(now())";
			// get custom weeks 
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and date(start) <= curdate()
						  and frequency = 'week' 
						  and custom = '1'
						  and week_day like concat('%', weekday(now()) + 1, '%') 
						  and mod(abs(weekofyear(now()) - weekofyear(start)), `interval`) = 0";
			// get custom months
			$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and date(start) <= curdate()
						  and frequency = 'month'
						  and custom = '1'
						  and week_day like concat('%', weekday(now()) + 1, '%') 
						  and if (dayofweek(now()) < dayofweek(concat(date_format(now(), '%Y-%m-'), '01')), ceil(day(now()) / 7), ceil(day(now()) / 7 + 1)) = week_number 
						  and mod(period_diff(date_format(now(), '%Y%m'), date_format(start, '%Y%m')), `interval`) = 0";
		} else if ($range == 'week') {
			$date = new DateTime();
			$interval = $date->format('N') - 1;
			$date->modify("-$interval day");
			for ($i = 0; $i < 7; $i++) {
				$dateString = $date->format('Y-m-d');
				$queries[] = "select * 
						  from calendar 
						  where user_id = '$userid' 
						  and '$dateString' = date(start)";
				// get non custom repeating days 
				$queries[] = "select * 
							  from calendar 
							  where user_id = '$userid' 
							  and date(start) <= '$dateString'
							  and frequency = 'day'
							  and custom != '1' 
							  and mod(datediff('$dateString', start), `interval`) = 0";
				// get non custom repeating weeks 
				$queries[] = "select * 
							  from calendar 
							  where user_id = '$userid' 
							  and date(start) <= '$dateString'
							  and frequency = 'week'
							  and custom != '1' 
							  and ceil(mod(datediff('$dateString', start) / 7, `interval`)) = 0";
				// get non custom repeating months 
				$queries[] = "select * 
							  from calendar 
							  where user_id = '$userid' 
							  and date(start) <= '$dateString'
							  and frequency = 'month'
							  and custom != '1' 
							  and mod(period_diff(date_format('$dateString', '%Y%m'), date_format(start, '%Y%m')), `interval`) = 0 
							  and day(start) = day('$dateString')";
				// get custom weeks 
				$queries[] = "select * 
							  from calendar 
							  where user_id = '$userid' 
							  and date(start) <= '$dateString'
							  and frequency = 'week' 
							  and custom = '1'
							  and week_day like concat('%', weekday('$dateString') + 1, '%') 
							  and mod(abs(weekofyear('$dateString') - weekofyear(start)), `interval`) = 0";
				// get custom months
				$queries[] = "select * 
							  from calendar 
							  where user_id = '$userid' 
							  and date(start) <= '$dateString'
							  and frequency = 'month'
							  and custom = '1'
							  and week_day like concat('%', weekday('$dateString') + 1, '%') 
							  and if (dayofweek('$dateString') < dayofweek(concat(date_format('$dateString', '%Y-%m-'), '01')), ceil(day('$dateString') / 7), ceil(day('$dateString') / 7 + 1)) = week_number 
							  and mod(period_diff(date_format('$dateString', '%Y%m'), date_format(start, '%Y%m')), `interval`) = 0";
				$date->modify('+1 day');	
			}
		}
		$query = implode(' union ', $queries);
		return $this->getAdapter()->fetchAll($query);
    }
}