<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 23.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if(isset($_POST['textcontent'])){
	add_reply($_POST['rep_id'], $_POST['com_id'], $_POST['textcontent']);
	$last = last_replies();

	$last_reply = last_reply($last->message_id, $last->id_reply, $_SESSION['sk_id']);
	echo $last_reply;
}

?>