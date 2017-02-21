<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

up_views_topic($_GET['id']);
$topic = infos_topic_forum($_GET['id']);
$replies = topic_replies($_GET['id']);

$form = new Languages('form');
$fofo = new Languages('forum');

$description = link_click(nl2br(smiley($topic->description)));

$member = member_info($topic->user_id);
$avatar = member_photo($topic->user_id);
$time = duration($topic->TimeTopic);
$nb_topics = number_topics_user($topic->user_id);
$nb_replies = number_replies_user($topic->user_id);

if($nb_topics->n_topics < 2){
	$topics_user = $nb_topics->n_topics.' '.$fofo->sokial('R15');
}else{
	$topics_user = $nb_topics->n_topics.' '.$fofo->sokial('R16');
}

if($nb_replies->n_replies < 2){
	$replies_user = $nb_replies->n_replies.' '.$fofo->sokial('R17');
}else{
	$replies_user = $nb_replies->n_replies.' '.$fofo->sokial('R18');
}

switch($avatar->file) {
	case '':
		$photo_profil = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_profil = $domaine.$avatar->file;
		break;
}

include SK_VIEW.FILE;

include 'footer.php';

?>