<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 14.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

if(isset($_POST['link_music'])){

	$link = $_POST['link_music'];
	$user = member_info($_SESSION['sk_id']);

	if(strpos($link, 'soundcloud.com')){
		$type = 'SoundCloud';
	}elseif(strpos($link, 'mixcloud.com')){
		$type = 'Mixcloud';
	}

	$yout = explode("v=", $link);

	switch($type) {
		case 'SoundCloud':
			$xml = soundcloud($link);
			$title = $xml->title;
			$thumb = SK_IMG.'soundcloud.png';
			$embed = $xml->html;
			break;
		case 'Mixcloud':
			$xml = mixcloud($link);
			$title = $xml->title;
			$thumb = 'http:'.$xml->image;
			$embed = '<iframe width="750" height="180" src="//www.mixcloud.com/widget/iframe/?feed='.$link.'&amp;replace=0&amp;hide_cover=1&amp;embed_type=widget_standard&amp;hide_tracklist=0" frameborder="0"></iframe>';
			break;
		default:
			$title = '';
			$thumb = '';
			$embed = '';
			break;
	}

	add_music($user->id_user, 6, $type, $link, $thumb, $title, $embed, 1);
	$last = last_id_music();
	feed_add_music($user->id_user, $last->id_music);

	$last_id_feed = last_id_feed();
	$last_music_feed = last_music_feed($last_id_feed->id_feed,$user->id_user);

	echo $last_music_feed;
}

?>