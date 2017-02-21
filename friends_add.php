<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 23.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if($_POST['id']){

	$user = member_info($_SESSION['sk_id']);
	$nb_friends = number_friends_profil($user->id_user, $_POST['id']);

	if($nb_friends->n_friends == 0){

		$members = new Languages('members');

		add_friend($_POST['id']);
		notif_add_friend($_SESSION['sk_id'], $_POST['id']);

		echo '<span style="cursor:default">&#8730; '.$members->sokial('M19').'</span>';
	}
}

?>