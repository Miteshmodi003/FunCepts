<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 23.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

if(isset($_POST['publish_profil'])){
	$user = member_info($_SESSION['sk_id']);

	feed_status_profil($user->id_user, $_POST['publish_profil'], $_GET['id']);

	$last = last_id_feed();
	$feed = last_status_profil($last->id_feed,$user->id_user);

	echo $feed;
}

?>