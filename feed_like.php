<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.08.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

$feeds = new Languages('feeds');

if(isset($_POST['id'])){

	$db = SokialDB::getInstance();
	$user = member_info($_SESSION['sk_id']);

	$lik = $db->prepare("SELECT user_id FROM feeds_likes WHERE user_id = :id AND feed_id = :feed_id ");
	$lik->bindValue(':id', $user->id_user, PDO::PARAM_INT);
	$lik->bindValue(':feed_id', $_POST['id'], PDO::PARAM_INT);
	$lik->execute();
	$nb_lik = $lik->rowCount();

	if($nb_lik == 0){
		feed_like($_POST['id'], $user->id_user);
		up_like($_POST['id']);
		echo '<span class="like_this">'.$feeds->sokial('X19').'</span>';
	}
}

?>