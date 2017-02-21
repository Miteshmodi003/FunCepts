<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 27.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

$evnt = new Languages('events');

if($_POST['id']){

	$db = SokialDB::getInstance();
	$user = member_info($_SESSION['sk_id']);

	$lik = $db->exec("DELETE FROM events_going WHERE user_id = '".$user->id_user."' AND event_id = '".$_POST['id']."' ");
	echo '<span class="like_this">&#8730; '.$evnt->sokial('E16').'</span>';
}

?>