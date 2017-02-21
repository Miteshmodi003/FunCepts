<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 25.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

$members = new Languages('members');

$nf_friends = number_friends($_SESSION['sk_id']);
$idfriends = list_friends_feeds($_SESSION['sk_id']);

switch ($nf_friends->nf_friend) {
	case 0:
		$feeds = '<div class="no_results">'.$members->sokial('M22').'</div>';
		break;
	default:
		$feeds = feeds_friends($idfriends);
		break;
}

echo $feeds;

?>