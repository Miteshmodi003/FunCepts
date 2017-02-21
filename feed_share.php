<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 31.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

$feeds = new Languages('feeds');

if(isset($_POST['id'])){

	$db = SokialDB::getInstance();
	$user = member_info($_SESSION['sk_id']);

	up_share($_POST['id']);
	echo '<span class="like_this">&#8730; '.$feeds->sokial('X34').'</span>';

}

?>