<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 05.09.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if($_POST['id']){

	$db = SokialDB::getInstance();
	$group = new Languages('groups');
	$user_id = $_SESSION['sk_id'];
	$group_id = $_POST['id'];

	$db->exec("DELETE FROM groups_members WHERE user_id = $user_id AND group_id = $group_id");
	echo '<span style="cursor:default">&#8730; '.$group->sokial('O19').'</span>';
}

?>