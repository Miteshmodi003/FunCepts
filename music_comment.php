<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.08.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if(isset($_POST['textcontent'])){
	$user = member_info($_SESSION['sk_id']);
	music_comment($_POST['com_id'], $user->id_user, $_POST['textcontent']);
	up_comment_music($_POST['com_id']);
	feed_comment_music($user->id_user, $_POST['textcontent']);

	$comment = last_comment_music($_POST['com_id']);
	echo $comment;
}

?>