<?php
include('config.php');
include('api.php');
$arr['topic']='Instadoc19';
$arr['start_date']=date('2022-01-05 00:02:30');
$arr['duration']=30;
$arr['password']='instant22';
$arr['type']='2';
$result=createMeeting($arr);
if(isset($result->id)){
	echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
	echo "Password: ".$result->password."<br/>";
	echo "Start Time: ".$result->start_time."<br/>";
	echo "Duration: ".$result->duration."<br/>";
}else{
	echo '<pre>';
	print_r($result->join_url);
}
?>