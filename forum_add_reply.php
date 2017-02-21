<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if(isset($_POST['textcontent'])){
	$user = member_info($_SESSION['sk_id']);
	add_reply_topic($_POST['cat_id'], $_POST['com_id'], $user->id_user, $_POST['textcontent']);

	$reply = topic_last_reply($_POST['com_id']);
	echo '<div id="replies">'.$reply.'</div>';
}

?>