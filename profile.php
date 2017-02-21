<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 31.12.14
// Version 3.0.5

include 'header.php';
require(CORE.'Feeds.php');

$members = new Languages('members');
$home = new Languages('home');

$id_profil = $_GET['id'];

up_views_profil($id_profil);
$profil = member_info($id_profil);
$avatar = member_photo($id_profil);

switch($avatar->file) {
	case '':
		$photo_profil = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_profil = $domaine.$avatar->file;
		break;
}

if(connected_member()) {

	$nb_friends = number_friends_add($user->id_user, $id_profil);

	if($nb_friends->n_friends > 0){
		$add_friend = '<a href="" title="" class="sk-bubble btn_profil friend" id="'.$id_profil.'" sokial="'.$members->sokial('M20').'"><i class="fa fa-user"></i></a>';
	}
	else{
		$add_friend = '<a href="" title="" class="sk-bubble btn_profil friend" name="add_friend" id="'.$id_profil.'" sokial="'.$members->sokial('M09').'"><i class="fa fa-user"></i></a>';
	}

	switch($user->id_user) {
		case $id_profil:
			$add_cover = '<a href="'.$domaine.'user/cover" title="" class="sk-bubble btn_profil" sokial="'.$members->sokial('M07').'"><i class="fa fa-camera"></i></a>';
			$add_photo = '<a href="'.$domaine.'user/picture" title="" class="sk-bubble btn_profil" sokial="'.$members->sokial('M08').'"><i class="fa fa-picture-o"></i></a>';
			break;
		default:
			$add_cover = $add_friend;
			$add_photo = '<a href="#" title="" data-width="500" data-rel="SendMessage" class="sk-bubble btn_profil poplight" rel="popup_name" sokial="'.$members->sokial('M10').'"><i class="fa fa-comments-o"></i></a>';
			break;
	}

}

$items_per_group = 9;
$db = SokialDB::getInstance();
$mf = $db->query("SELECT COUNT(id_feed) as f_records FROM feeds WHERE user_id = $id_profil");
$mf->execute();
$setf=$mf->fetch(PDO::FETCH_OBJ);
$total_groups = ceil($setf->f_records/$items_per_group);

switch($profil->sex) {
	case '1':
		$sex = $members->sokial('M01');
		break;
	default:
		$sex = $members->sokial('M02');
		break;
}

$country = country($profil->country);

$cover = member_cover($id_profil);

switch($cover->file) {
	case '':
		$cover = $domaine.'files/cover/default.png';
		break;
	default:
		$cover = $domaine.$cover->file;
		break;
}

// Photos //

$photo = new Languages('photos');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$list_photos = list_photos_user($id_profil,$page,$set->page_photos);
$nb_photo = photos_number_user($id_profil);

$nbr_photo = $nb_photo->n_photos;

$list_photos = $nbr_photo != 0 ? $list_photos : $photo->sokial('P05');

$nb_pages = ceil($nbr_photo / $set->page_photos);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

// Videos //

$video = new Languages('videos');

$list_videos = list_videos_user($id_profil);
$nb_video = videos_number_user($id_profil);

$nbr_video = $nb_video->n_videos;

$list_videos = $nbr_video != 0 ? $list_videos : $video->sokial('V14');

// Music //

$list_musics = list_musics_user($id_profil,$page,$set->page_music);
$nb_music = musics_number_user($id_profil);

$nbr_music = $nb_music->n_musics;

$list_musics = $nbr_music != 0 ? $list_musics : 'No music';

$nb_pages = ceil($nbr_music / $set->page_music);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

// Blogs //

$blog = new Languages('blogs');

$list_blogs = list_blogs_user($id_profil,$page,$set->page_blogs);
$nb_blog = blogs_number_user($id_profil);

$nbr_blog = $nb_blog->n_blogs;

$list_blogs = $nbr_blog != 0 ? $list_blogs : $blog->sokial('B07');

$nb_pages = ceil($nbr_blog / $set->page_blogs);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

// Friends //

$blog = new Languages('blogs');

$list_friends = list_friends($page,$set->page_friends,$id_profil);
$nb_friend = number_friends($id_profil);

$nbr_friend = $nb_friend->nf_friend;

$list_friends = $nbr_friend != 0 ? $list_friends : 'No friends';

$nb_pages = ceil($nbr_friend / $set->page_friends);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

// Groups //

$photo = new Languages('photos');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$list_groups = list_groups_user($id_profil,$page,$set->page_photos);
$nb_group = groups_number_user($id_profil);

$nbr_group = $nb_group->n_groups;

$list_groups = $nbr_group != 0 ? $list_groups : $photo->sokial('P05');

$nb_pages = ceil($nbr_group / $set->page_groups);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

// Message //

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $mec = $db->query("SELECT sender,receiver FROM messages WHERE (sender = $id_profil AND receiver = $user->id_user) OR (receiver = $id_profil AND sender = $user->id_user)");
	$mec->setFetchMode(PDO::FETCH_OBJ);
	$nbr_conv = $mec->rowCount();
	if($nbr_conv == 0){
		send_message($user->id_user, $id_profil);
		$last = last_id_message($user->id_user, $id_profil);
		send_message_reply($last->id_message, $user->id_user, $id_profil, $_POST['message']);
	}elseif($nbr_conv > 0){
		$last = last_id_message($user->id_user, $id_profil);
		send_message_reply($last->id_message, $user->id_user, $id_profil, $_POST['message']);
	}
	$success = $members->sokial('M13');
}

include SK_VIEW.FILE;

include 'footer.php';

?>