<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 27.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

$evnt = new Languages('events');

if(isset($_POST['id'])){

	$db = SokialDB::getInstance();
	$user = member_info($_SESSION['sk_id']);

	$lik = $db->prepare("SELECT user_id FROM events_going WHERE user_id = :id AND event_id = :event_id ");
	$lik->bindValue(':id', $user->id_user, PDO::PARAM_INT);
	$lik->bindValue(':event_id', $_POST['id'], PDO::PARAM_INT);
	$lik->execute();
	$nb_lik = $lik->rowCount();

	if($nb_lik == 0){
		event_going($_POST['id'], $user->id_user);
		event_going_event($user->id_user, $_POST['id']);
		echo '<span class="like_this">&#8730; '.$evnt->sokial('E15').'</span>';
	}
}

?>