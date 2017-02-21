<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 06.09.15
// Version 3.0.5

include 'header.php';
require(CORE.'Feeds.php');

access_member();

$members = new Languages('members');
$home = new Languages('home');
$group = new Languages('groups');

$id_group = $_GET['id'];

$view = group_info($id_group);

$users = list_members_group($id_group);

$items_per_group = 9;
$db = SokialDB::getInstance();
$mf = $db->query("SELECT COUNT(id_feed) as f_records FROM feeds WHERE user_id = $id_group");
$mf->execute();
$setf=$mf->fetch(PDO::FETCH_OBJ);
$total_groups = ceil($setf->f_records/$items_per_group);

$avatar = group_photo($id_group);

switch($avatar->file) {
	case '':
		$photo_profil = $domaine.'files/groups/profil/150x_nophoto.png';
		break;
	default:
		$photo_profil = $domaine.$avatar->file;
		break;
}

$user_group = number_user_group($user->id_user, $id_group);

if($user_group->n_members > 0){
	$meet = '<a href="" title="" class="sk-bubble btn_profil join" id="'.$id_group.'" sokial="'.$group->sokial('O16').'"><i class="fa fa-sign-out"></i></a>';
}
else{
	$meet = '<a href="" title="" class="sk-bubble btn_profil join" name="meet_group" id="'.$id_group.'" sokial="'.$group->sokial('O17').'"><i class="fa fa-sign-in"></i></a>';
}

switch($user->id_user) {
	case $view->user_id:
		$add_cover = '<a href="'.$domaine.'groups_cover.php?id='.$id_group.'" title="" class="sk-bubble btn_profil" sokial="'.$group->sokial('O14').'"><i class="fa fa-camera"></i></a>';
		$add_photo = '<a href="'.$domaine.'groups_photo.php?id='.$id_group.'" title="" class="sk-bubble btn_profil" sokial="'.$group->sokial('O15').'"><i class="fa fa-picture-o"></i></a>';
		break;
	default:
		$add_cover = $meet;
		$add_photo = '<a href="#" title="" data-width="500" data-rel="SendMessage" class="sk-bubble btn_profil poplight" rel="popup_name" sokial="'.$members->sokial('M10').'"><i class="fa fa-comments-o"></i></a>';
		break;
}

$cover = group_cover($id_group);

switch($cover->file) {
	case '':
		$cover = $domaine.'files/cover/default.png';
		break;
	default:
		$cover = $domaine.$cover->file;
		break;
}

// Message //

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $mec = $db->query("SELECT sender,receiver FROM messages WHERE (sender = $view->user_id AND receiver = $user->id_user) OR (receiver = $view->user_id AND sender = $user->id_user)");
	$mec->setFetchMode(PDO::FETCH_OBJ);
	$nbr_conv = $mec->rowCount();
	if($nbr_conv == 0){
		send_message($user->id_user, $view->user_id);
		$last = last_id_message($user->id_user, $view->user_id);
		send_message_reply($last->id_message, $user->id_user, $view->user_id, $_POST['message']);
	}elseif($nbr_conv > 0){
		$last = last_id_message($user->id_user, $view->user_id);
		send_message_reply($last->id_message, $user->id_user, $view->user_id, $_POST['message']);
	}
	$success = $members->sokial('M13');
}

include SK_VIEW.FILE;

include 'footer.php';

?>