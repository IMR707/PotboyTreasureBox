<?php

	define('_VALID_PHP', true);
	require_once '../init.php';

	$gameSetting = $fz->getFreeGame();

	// pre($gameSetting);
	// exit;

	$time_to_die = $gameSetting->time_limit;
	$jelly1_score = $gameSetting->score_yellow;
	$jelly3_score = $gameSetting->score_red;
	$jelly4_score = $gameSetting->score_green;
	$jelly5_score = $gameSetting->score_blue;
	$jelly6_score = $gameSetting->score_pink;
	$send_score_url = "../API/game.php";
	$multiplier = $gameSetting->score_multiplier;

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
