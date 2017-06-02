<?php

	define('_VALID_PHP', true);
	require_once '../init.php';

	$gameSetting = $fz->getDiamondGame();

	$time_to_die = 650;
	$enemy1_score = 20;
	$enemy2_score = 30;
	$enemy3_score = 40;
	$enemy4_score = 50;
	$enemy5_score = 80;
	$medium_boss_score = 80;
	$asteroid_score = 90;
	$seaship_score = 90;
	$final_boss_score = 120;
	$multiplier = 2;
	$gold_score = 100;
	$silver_score = 50;

	$send_score_url = "../API/game.php";

	$data_first = array(
			array($time_to_die),
			array($multiplier),
			array($send_score_url),
	);

	$data_second = array(
		array($gold_score),
		array($silver_score)
	);
	$data_third = array(
		array($enemy1_score),
		array($enemy2_score),
		array($enemy3_score),
		array($enemy4_score),
		array($enemy5_score),
		array($medium_boss_score),
		array($asteroid_score),
		array($final_boss_score),
		array($seaship_score)
	);

	$data = array(
		$data_first,
		$data_second,
		$data_third
	);

	$return_value = array(
			"c2array"=> true,
			"size" => array(count($data),count($data_third),1), // num_of_row, num_of_field, 3d_array_row
			"data" => ($data)
	);

	echo json_encode($return_value);

	//echo $time_to_die;
