<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 06.09.15
// Version 3.0.5

include 'header.php';

access_member();

$photo = new Languages('photos');
$feeds = new Languages('feeds');
$general = new Languages('general');

$ads = advertising();

$view = photo_info($_GET['id']);
$user = member_info($view->user_id);
$avatar = member_photo($view->user_id);
up_view_photo($_GET['id']);

$comments = comments_photo($view->id_photo);

$time = duration($view->TimePhoto);

switch($avatar->file) {
	case '':
		$photo_user = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_user = $domaine.$avatar->file;
		break;
}

$num = $view->size/1024;
$weight = number_format($num,2);

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

$li = $db->prepare("SELECT user_id,photo_id FROM photos_likes WHERE user_id = :user_id AND photo_id = :photo_id ");
$li->bindValue(':user_id',$_SESSION['sk_id'],PDO::PARAM_INT);
$li->bindValue(':photo_id',$view->id_photo,PDO::PARAM_INT);
$li->execute();
$nbr_like = $li->rowCount();

switch($nbr_like) {
	case 0:
		$like = '<li class="likep" id="'.$view->id_photo.'" name="like_photo"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X02').'</a></li>';
		break;
	default:
		$like = '<li class="likep" id="'.$view->id_photo.'"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X03').'</a></li>';
		break;
}

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    feed_share_photo($_SESSION['sk_id'], $_POST['comment'], $view->id_photo);
    up_share_photo($view->id_photo);
}

include SK_VIEW.FILE;

include 'footer.php';

?>