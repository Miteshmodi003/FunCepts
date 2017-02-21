<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.10.15
// Version 3.0.5

include 'header.php';

access_member();

$photo = new Languages('photos');
$blog = new Languages('blogs');
$feeds = new Languages('feeds');
$general = new Languages('general');

$ads = advertising();

$view = blog_info($_GET['id']);
$user = member_info($view->user_id);
$avatar = member_photo($view->user_id);
$cat = cat_blog($view->cat_id);
up_view_blog($_GET['id']);

$comments = comments_blog($view->id_blog);

$time = duration($view->TimeBlog);

$description = link_click(nl2br(smiley($view->description)));

switch($avatar->file) {
	case '':
		$photo_user = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_user = $domaine.$avatar->file;
		break;
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

$li = $db->prepare("SELECT user_id,blog_id FROM blogs_likes WHERE user_id = :user_id AND blog_id = :blog_id ");
$li->bindValue(':user_id',$_SESSION['sk_id'],PDO::PARAM_INT);
$li->bindValue(':blog_id',$view->id_blog,PDO::PARAM_INT);
$li->execute();
$nbr_like = $li->rowCount();

switch($nbr_like) {
	case 0:
		$like = '<li class="likeb" id="'.$view->id_blog.'" name="like_blog"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X02').'</a></li>';
		break;
	default:
		$like = '<li class="likeb" id="'.$view->id_blog.'"><a href="" title=""><i class="fa fa-thumbs-o-up"></i>'.$feeds->sokial('X03').'</a></li>';
		break;
}

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    feed_share_blog($_SESSION['sk_id'], $_POST['comment'], $view->id_blog);
    up_share_blog($view->id_blog);
}

include SK_VIEW.FILE;

include 'footer.php';

?>