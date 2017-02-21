<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 06.09.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if($_POST['id']){

	$db = SokialDB::getInstance();
	$members = new Languages('members');
	$user1 = $_POST['id'];
	$user2 = $_SESSION['sk_id'];

	$db->exec("DELETE FROM friends WHERE (user1 = $user1 AND user2 = $user2) OR (user2 = $user1 AND user1 = $user2)");
	$db->exec("DELETE FROM notifs_friends WHERE sender = $user2 AND receiver = $user1");
	echo '<span style="cursor:default">&#8730; '.$members->sokial('M21').'</span>';
}

?>