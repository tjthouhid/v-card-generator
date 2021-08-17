<?php
// echo "<pre>";
// print_r($_GET);
//require dirname(__FILE__).'/autoload.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';
if(isset($_GET['do']))
{
	$VCalendar = new Davaxi\VCalendar($fileName = 'invite');
	$VCalendar->setProcess('VCalendar', 'VCalendar Events', 'v1.0', 'EN');
	$VCalendar->setMethod('PUBLISH');
	if(isset($_GET['calendar_name'])){
		$VCalendar->setCalendarName('Events - '.$_GET['calendar_name']);
	}else{
		$VCalendar->setCalendarName('Events - Test');
	}
	$VCalendar->setTimeZone('Europe/Paris');
	if(isset($_GET['all_day'])){
		$all_day = $_GET['all_day'];
	}else{
		$all_day = "yes";
	}

	if(isset($_GET['date_start'])){
		$date_start = $_GET['date_start'];
	}else{
		$date_start = date("Y-m-d");
	}
	if(isset($_GET['date_end'])){
		$date_end = $_GET['date_end'];
	}else{
		$date_end = date("Y-m-d");
	}
	if(isset($_GET['time_start'])){
		$time_start = $_GET['time_start'];
	}else{
		$time_start = "00:00:00";
	}
	if(isset($_GET['time_end'])){
		$time_end = $_GET['time_end'];
	}else{
		$time_end = "23:59:59";
	}
	if($all_day == "yes"){
		$start_date = $date_end." 00:00:00";
		$end_date = $date_end." 23:59:59";
	}else{
		$start_date = $date_end." ".$time_start;
		$end_date = $date_end." ".$time_end;
	}
	$VCalendar->setStartDateTime($start_date);
	$VCalendar->setEndDateTime($end_date);
	$VCalendar->setStatus('CONFIRMED');
	if(isset($_GET['title'])){
		$VCalendar->setTitle($_GET['title']);
	}
	if(isset($_GET['description'])){
		$VCalendar->setDescription($_GET['description']);
	}
	// if(isset($_GET['description'])){
	// 	$VCalendar->setOrganizer('Davaxi', 'root@domain.fr');
	// }
	$VCalendar->setClass('PUBLIC');
	$created_date = date("Y-m-d h:i:s");
	$VCalendar->setCreatedDateTime($created_date);
	$VCalendar->setLocation('Paris', 48.874086, 2.345640);
	if(isset($_GET['url'])&&$_GET['url']!=""){
		//$VCalendar->setUrl($_GET['url']);
		$VCalendar->setUrl("https://www.g.com");
	}
	$alert_value = $_GET['alert_value'];
	$alert_time = $_GET['alert_time'];
	$alert_type = $_GET['alert_type'];
	$alerts = array();
	for($i=0;$i<count($alert_value);$i++){
		//-P1W
		$str="";
		if($alert_type[$i]=="b"){
			$str.="-P";
		}else{
			$str.="P";
		}
		if($alert_time[$i]=="M"){
			$str.="T";
		}else{
			$str.="";
		}
		$str.=$alert_value[$i];
		$str.=$alert_time[$i];
		$alerts[]=$str;
	}
	$VCalendar->setAlert($alerts);
	//$VCalendar->setSequence(4);
	//$VCalendar->setLastUpdatedDateTime('2016-06-01 01:00:00');
	//$VCalendar->setCategories(array('ENTERTAINMENT'));
	//$VCalendar->setUID('event_davaxi_1');
	//$VCalendar->addAttendee('Guest', 'REQ-PARTICIPANT', 'guest@domain.com',false);
	// Stream file with header
	$VCalendar->stream();

}
?>