<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.08.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

$feeds = new Languages('feeds');

if($_POST['id']){

	$db = SokialDB::getInstance();
	$user = member_info($_SESSION['sk_id']);
	up_unlike_music($_POST['id']);

	$lik = $db->exec("DELETE FROM music_likes WHERE user_id = '".$user->id_user."' AND music_id = '".$_POST['id']."' ");
	echo '<span class="like_this">'.$feeds->sokial('X20').'</span>';
}

?>