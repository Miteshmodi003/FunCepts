<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 07.09.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$video = new Languages('videos');

$info = video_style($_GET['id']);
$member = member_info($info->user_id);
$cat = cat_videos($info->cat_id);

$style = new Form('upload', 'POST');
$style->action('');
$style->add('Text', 'ttl')
		->value($info->title)
		->add_class('title')
		->required();
$style->add('Textarea', 'descript')
		->value($info->description)
		->add_class('description')
		->required();
$style->add('Submit', 'submit')
		->value($form->sokial('F13'))
		->add_class('btn btn_green');
$style->bound($_POST);

if($style->is_valid($_POST)) {
	list($ttl, $descript) = $style->get_cleaned_data('ttl', 'descript');
	up_infos_video($info->id_video, $ttl, $descript);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'video/'.$info->id_video.'\');",2.0) </script>';
}

$nbr = strlen($title);
$name = htmlspecialchars(substr($title,0,50));

if($nbr>50){
	$titl = $name.'...';
}else{
	$titl = $info->title;
}

$nb = strlen($description);
$nam = htmlspecialchars(substr($description,0,150));

if($nb>150){
	$desc = $nam.'...';
}else{
	$desc = $info->description;
}

include SK_VIEW.FILE;

include 'footer.php';

?>