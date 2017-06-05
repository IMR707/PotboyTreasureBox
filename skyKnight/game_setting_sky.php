<?php

	define('_VALID_PHP', true);
	require_once '../init.php';

	$gameSetting = $fz->getDiamondGame();

	$time_to_die = $gameSetting->time_limit;

	$enemy1_score = $gameSetting->enemy1_score;
	$enemy2_score = $gameSetting->enemy2_score;
	$enemy3_score = $gameSetting->enemy3_score;
	$enemy4_score = $gameSetting->enemy4_score;
	$enemy5_score = $gameSetting->enemy5_score;
	$medium_boss_score = $gameSetting->medium_boss_score;
	$asteroid_score = $gameSetting->asteroid_score;
	$seaship_score = $gameSetting->seaship_score;
	$final_boss_score = $gameSetting->final_boss_score;
	$gold_score = $gameSetting->gold_score;
	$silver_score = $gameSetting->silver_score;

	$multiplier = $gameSetting->score_multiplier;

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
