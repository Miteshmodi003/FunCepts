<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.08.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

if(isset($_POST['publish'])){
	$user = member_info($_SESSION['sk_id']);
	feed_status($user->id_user, $_POST['publish']);

	$last = last_id_feed();
	$feed = last_status($last->id_feed,$user->id_user);

	echo $feed;
}

?>