<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.08.15
// Version 3.0.5

include 'header.php';

access_member();

$music = new Languages('music');
$feeds = new Languages('feeds');

$view = music_info($_GET['id']);
$cat = cat_music($view->cat_id);
up_view_music($_GET['id']);

$comments = comments_music($view->id_music);

$time = duration($view->TimeMusic);

$user = member_info($view->user_id);
$avatar = member_photo($view->user_id);

switch($avatar->file) {
	case '':
		$photo_user = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_user = $domaine.$avatar->file;
		break;
}

$nbr = strlen($view->title);
$titl = htmlspecialchars(substr($view->title,0,50));

if($nbr>50){
	$title = $titl.'...';
}else{
	$title = $view->title;
}

switch($view->likes) {
	case 0:
		$total_like = '&nbsp;';
		break;
	case 1:
		$total_like = $view->likes.' '.$feeds->sokial('X07');
		break;
	default:
		$total_like = $view->likes.' '.$feeds->sokial('X08');
		break;
}

$db = SokialDB::getInstance();

$li = $db->prepare("SELECT user_id,music_id FROM music_likes WHERE user_id = :user_id AND music_id = :music_id ");
$li->bindValue(':user_id',$_SESSION['sk_id'],PDO::PARAM_INT);
$li->bindValue(':music_id',$view->id_music,PDO::PARAM_INT);
$li->execute();
$nbr_like = $li->rowCount();

switch($nbr_like) {
	case 0:
		$like = '<li class="likem" id="'.$view->id_music.'" name="like_music"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X02').'</a></li>';
		break;
	default:
		$like = '<li class="likem" id="'.$view->id_music.'"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X03').'</a></li>';
		break;
}

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    feed_share_music($_SESSION['sk_id'], $_POST['comment'], $view->id_music);
    up_share_music($view->id_music);
}

include SK_VIEW.FILE;

include 'footer.php';

?>