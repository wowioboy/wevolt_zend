<?php
class Wevolt_Form_Data
{
	static public function getStates()
	{
		return array(
    		"AL" => "Alabama",
    		"AK" => "Alaska", 
    		"AZ" => "Arizona", 
    		"AR" => "Arkansas", 
    		"CA" => "California", 
    		"CO" => "Colorado", 
    		"CT" => "Connecticut", 
    		"DE" => "Delaware", 
    		"DC" => "District Of Columbia", 
    		"FL" => "Florida", 
    		"GA" => "Georgia", 
    		"HI" => "Hawaii", 
    		"ID" => "Idaho", 
    		"IL" => "Illinois", 
    		"IN" => "Indiana", 
    		"IA" => "Iowa", 
    		"KS" => "Kansas", 
    		"KY" => "Kentucky", 
    		"LA" => "Louisiana", 
    		"ME" => "Maine", 
    		"MD" => "Maryland", 
    		"MA" => "Massachusetts", 
    		"MI" => "Michigan", 
    		"MN" => "Minnesota", 
    		"MS" => "Mississippi", 
    		"MO" => "Missouri", 
    		"MT" => "Montana", 
    		"NE" => "Nebraska", 
    		"NV" => "Nevada", 
    		"NH" => "New Hampshire", 
    		"NJ" => "New Jersey", 
    		"NM" => "New Mexico", 
    		"NY" => "New York", 
    		"NC" => "North Carolina", 
    		"ND" => "North Dakota", 
    		"OH" => "Ohio", 
    		"OK" => "Oklahoma", 
    		"OR" => "Oregon", 
    		"PA" => "Pennsylvania", 
    		"RI" => "Rhode Island", 
    		"SC" => "South Carolina", 
    		"SD" => "South Dakota", 
    		"TN" => "Tennessee", 
    		"TX" => "Texas", 
    		"UT" => "Utah", 
    		"VT" => "Vermont", 
    		"VA" => "Virginia", 
    		"WA" => "Washington", 
    		"WV" => "West Virginia", 
    		"WI" => "Wisconsin", 
    		"WY" => "Wyoming");
	}
	
	static public function getTimes()
	{
		return array('00:00:00' => '12:00 am',
					 '00:30:00' => '12:30 am',
					 '01:00:00' => '1:00 am', 
					 '01:30:00' => '1:30 am', 
					 '02:00:00' => '2:00 am',
					 '02:30:00' => '2:30 am',
					 '03:00:00' => '3:00 am',
					 '03:30:00' => '3:30 am',
					 '04:00:00' => '4:00 am',
					 '04:30:00' => '4:30 am',
					 '05:00:00' => '5:00 am',
					 '05:30:00' => '5:30 am',
					 '06:00:00' => '6:00 am',
					 '06:30:00' => '6:30 am',
					 '07:00:00' => '7:00 am',
					 '07:30:00' => '7:30 am',
					 '08:00:00' => '8:00 am',
					 '08:30:00' => '8:30 am',
					 '09:00:00' => '9:00 am',
					 '09:30:00' => '9:30 am',
					 '10:00:00' => '10:00 am',
					 '10:30:00' => '10:30 am',
					 '11:00:00' => '11:00 am',
					 '11:30:00' => '11:30 am',
					 '12:00:00' => '12:00 pm',
					 '12:30:00' => '12:30 pm',
					 '13:00:00' => '1:00 pm',
					 '13:30:00' => '1:30 pm',
					 '14:00:00' => '2:00 pm',
					 '14:30:00' => '2:30 pm',
					 '15:00:00' => '3:00 pm',
					 '15:30:00' => '3:30 pm',
					 '16:00:00' => '4:00 pm',
					 '16:30:00' => '4:30 pm',
					 '17:00:00' => '5:00 pm',
					 '17:30:00' => '5:30 pm',
					 '18:00:00' => '6:00 pm',
					 '18:30:00' => '6:30 pm',
					 '19:00:00' => '7:00 pm',
					 '19:30:00' => '7:30 pm',
					 '20:00:00' => '8:00 pm',
					 '20:30:00' => '8:30 pm',
					 '21:00:00' => '9:00 pm',
					 '21:30:00' => '9:30 pm',
					 '22:00:00' => '10:00 pm',
					 '22:30:00' => '10:30 pm',
					 '23:00:00' => '11:00 pm',
					 '23:30:00' => '11:30 pm');
	}
	
	static public function getFrequencies()
	{
		return array(''      => 'one time', 
					 'day'   => 'daily', 
					 'week'  => 'weekly', 
					 'month' => 'monthly');
	}
	
	static public function getEventTypes()
	{
		return array('event'     => 'event',
        			 'reminder'  => 'reminder',
					 'todo'      => 'to do',
					 'promotion' => 'promotion');
	}
	
	static public function getWeekNumbers()
	{
		return array(1 => '1st',
        			 2 => '2nd',
        			 3 => '3rd',
        			 4 => '4th',
        			 5 => 'last');
	}
	
	static public function getWeekDays()
	{
		return array(1 => ' Mo', 
					 2 => ' Tu', 
					 3 => ' We', 
					 4 => ' Th', 
					 5 => ' Fr', 
					 6 => ' Sa', 
					 7 => ' Su');
	}
}