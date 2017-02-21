<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 21.09.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

$header = new Languages('header');
$general = new Languages('general');

add_stat();

$current_lang = !empty($_SESSION['language']) ? current_languages($_SESSION['language']) : current_languages(SK_LANG);

if(connected_member()) {
	$user = member_info($_SESSION['sk_id']);
	$avatar = member_photo($user->id_user);
	$nb_nfriend = number_notifs_friends($user->id_user);

	switch($nb_nfriend->n_nfriend) {
		case 0:
			$notif_friend = '';
			break;
		default:
			$notif_friend = '<span class="notif notif_friend">'.$nb_nfriend->n_nfriend.'</span>';
			break;
	}

	switch($avatar->file) {
		case '':
			$photo_profil = $domaine.'files/users/150x_nophoto.gif';
			break;
		default:
			$photo_profil = $domaine.$avatar->file;
			break;
	}
}

$page = basename($_SERVER['PHP_SELF']);
$select = ' class="active"';

switch($page) {
	case 'home.php':
	case 'home_friends.php':
	case 'home_photos.php':
	case 'home_videos.php':
	case 'home_music.php':
		$sk1 = $select;
		break;
	default:
		$sk1 = '';
		break;
}
switch($page) {
	case 'members.php':
	case 'members_online.php':
	case 'members_last.php':
	case 'members_popular.php':
	case 'profile.php':
	case 'friends.php':
		$sk2 = $select;
		break;
	default:
		$sk2 = '';
		break;
}
switch($page) {
	case 'photos.php':
	case 'photos_upload.php':
	case 'photos_style.php':
	case 'photos_user.php':
	case 'photos_view.php':
	case 'photos_viewed.php':
	case 'photos_popular.php':
		$sk3 = $select;
		break;
	default:
		$sk3 = '';
		break;
}
switch($page) {
	case 'videos.php':
	case 'videos_upload.php':
	case 'videos_style.php':
	case 'videos_user.php':
	case 'videos_view.php':
	case 'videos_popular.php':
	case 'videos_viewed.php':
		$sk4 = $select;
		break;
	default:
		$sk4 = '';
		break;
}
switch($page) {
	case 'music.php':
	case 'music_upload.php':
	case 'music_user.php':
	case 'music_view.php':
	case 'music_listened.php':
	case 'music_popular.php':
		$sk5 = $select;
		break;
	default:
		$sk5 = '';
		break;
}
switch($page) {
	case 'blogs.php':
	case 'blogs_upload.php':
	case 'blogs_user.php':
	case 'blogs_view.php':
		$sk6 = $select;
		break;
	default:
		$sk6 = '';
		break;
}
switch($page) {
	case 'forum.php':
	case 'forum_add.php':
	case 'forum_cat.php':
	case 'forum_topic.php':
	case 'forum_user.php':
		$sk7 = $select;
		break;
	default:
		$sk7 = '';
		break;
}
switch($page) {
	case 'events.php':
	case 'events_add.php':
	case 'events_user.php':
	case 'events_view.php':
		$sk8 = $select;
		break;
	default:
		$sk8 = '';
		break;
}
switch($page) {
	case 'groups.php':
	case 'groups_add.php':
	case 'groups_user.php':
	case 'groups_photo.php':
	case 'groups_cover.php':
	case 'groups_view.php':
		$sk9 = $select;
		break;
	default:
		$sk9 = '';
		break;
}
switch($page) {
	case 'games.php':
	case 'games_view.php':
	case 'games_play.php':
		$sk10 = $select;
		break;
	default:
		$sk10 = '';
		break;
}

$selected = ' class="selected"';

switch($page) {
	case 'home.php':
		$fk1 = $selected;
		$feed_load = 'feeds.php';
		break;
	default:
		$fk1 = '';
		break;
}
switch($page) {
	case 'home_friends.php':
		$fk2 = $selected;
		$feed_load = 'feeds_friends.php';
		break;
	default:
		$fk2 = '';
		break;
}
switch($page) {
	case 'home_photos.php':
		$fk3 = $selected;
		$feed_load = 'feeds_photos.php';
		break;
	default:
		$fk3 = '';
		break;
}
switch($page) {
	case 'home_videos.php':
		$fk4 = $selected;
		$feed_load = 'feeds_videos.php';
		break;
	default:
		$fk4 = '';
		break;
}
switch($page) {
	case 'home_music.php':
		$fk5 = $selected;
		$feed_load = 'feeds_music.php';
		break;
	default:
		$fk5 = '';
		break;
}
switch($page) {
	case 'home_sharp.php':
		$feed_load = 'feeds_sharp.php?id='.$_GET['id'].'';
		break;
	default:
		$fk5 = '';
		break;
}

include SK_VIEW.'header.php';

?>