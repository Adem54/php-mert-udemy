<?php 
echo "SORT AFTER DATE: <br>";

$events_arr = array(  
	array('title' => 'Event 1', 'date' => '2022-02-25'),  
	array('title' => 'Event 2', 'date' => '2022-02-21'),  
	array('title' => 'Event 3', 'date' => '2022-02-15'),  
	array('title' => 'Event 4', 'date' => '2022-01-22'),  
	array('title' => 'Event 5', 'date' => '2022-01-18')  
 );


 usort($events_arr, function($a, $b) { 
	return strtotime($a['date']) - strtotime($b['date']); 
 });//Tarihi eskiden yeni gore siraliyor...

 print_r($events_arr);

 
 //BURDA DA TARIHI YENIDEN ESKIYE DOGRU SIRALANIYOR

 $events_arr2 = array(  
	array('title' => 'Event 1', 'date' => '2022-02-25'),  
	array('title' => 'Event 2', 'date' => '2022-02-21'),  
	array('title' => 'Event 3', 'date' => '2022-02-15'),  
	array('title' => 'Event 4', 'date' => '2022-01-22'),  
	array('title' => 'Event 5', 'date' => '2022-01-18')  
 );


 usort($events_arr2, function($a, $b) { 
	return strtotime($b['date']) - strtotime($a['date']); 
 });

 print_r($events_arr2);


?>