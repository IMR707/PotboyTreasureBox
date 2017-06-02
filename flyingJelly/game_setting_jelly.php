<?php

	$time_to_die = 240;
	$jelly1_score = 1;
	$jelly3_score = 2;
	$jelly4_score = 3;
	$jelly5_score = 4;
	$jelly6_score = 5;
	//$send_score_url = "../API/game.php";
	$send_score_url = "../ajax/savejelly_score.php";
	$multiplier = 3;
	
	//$game_setting = array("time_to_die"=>$time_to_die);
	
	//echo json_encode($game_setting);
	
	$data_first = array(
			array($time_to_die),
			array($jelly1_score),
			array($jelly3_score),
			array($jelly4_score),
			array($jelly5_score),
			array($jelly6_score),
			array($send_score_url),
			array($multiplier)
	);
	$data_second = array();
	$data_third = array();
	
	$data = array(
		$data_first,
		//$data_second,
		//$data_third
	);
	
	$return_value = array(
			"c2array"=> true,
			"size" => array(1, count($data_first),1), // num_of_row, num_of_field, 3d_array_row
			"data" => ($data)
	);
	
	echo json_encode($return_value);
	
	//echo $time_to_die;