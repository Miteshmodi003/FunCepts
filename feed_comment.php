<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 04.08.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

if(isset($_POST['textcontent'])){
	$user = member_info($_SESSION['sk_id']);
	feed_comment($_POST['com_id'], $user->id_user, $_POST['textcontent']);
	up_comment($_POST['com_id']);
	$comment = last_comment($_POST['com_id']);
	echo $comment;
}

?>