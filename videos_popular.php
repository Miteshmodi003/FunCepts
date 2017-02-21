<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.10.15
// Version 3.0.5

include 'header.php';

access_member();

$video = new Languages('videos');

$last = last_id_video_user($_SESSION['sk_id']);
$last_id = $last->id_video+1;

$info = video_info($last->id_video);
$member = member_info($info->user_id);
$cat = cat_videos($info->cat_id);

$nbr = strlen($info->title);
$titl = htmlspecialchars(substr($info->title,0,50));

if($nbr>50){
	$title = $titl.'...';
}else{
	$title = $info->title;
}

$nb = strlen($info->description);
$nam = htmlspecialchars(substr($info->description,0,250));

if($nb>250){
	$description = $nam.'...';
}else{
	$description = $info->description;
}

$list_videos = list_videos_popular();
$nb_video = videos_number();

$nbr_video = $nb_video->n_videos;

$list_videos = $nbr_video != 0 ? $list_videos : $video->sokial('V14');

include SK_VIEW.FILE;

include 'footer.php';

?>