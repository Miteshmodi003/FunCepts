<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 05.09.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if($_POST['id']){

	$user = member_info($_SESSION['sk_id']);
	$group = new Languages('groups');
	
	$user_group = number_user_group($user->id_user, $_POST['id']);

	if($user_group->n_members == 0){
		join_group($_SESSION['sk_id'], $_POST['id']);

		echo '<span style="cursor:default">&#8730; '.$group->sokial('O18').'</span>';
	}
}

?>