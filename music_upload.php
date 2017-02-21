<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 12.10.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$music = new Languages('music');

$y = SokialDB::getInstance();

$upload = new Form('upload', 'POST');
$upload->action('');
$upload->add('Select', 'type')
		->choices(array(
           'SoundCloud' => 'SoundCloud',
           'Mixcloud' => 'Mixcloud'
         ))
		->value('1')
		->label(''.$music->sokial('U05').'');
$categories = array();
foreach($y->query("SELECT id_cat,name FROM music_cat ORDER BY id_cat ASC") as $cat) {
	$categories[$cat['id_cat']] = $cat['name'];
}
$upload->add('Select', 'category')
		->choices($categories)
		->value('1')
		->label(''.$form->sokial('F17').'');
$upload->add('Select', 'privacy')
		->choices(array(
           '1' => $form->sokial('F18'),
           '2' => $form->sokial('F19'),
           '3' => $form->sokial('F20'),
           '4' => $form->sokial('F21')
         ))
		->value('1')
		->label(''.$music->sokial('U06').'');
$upload->add('Text', 'url')
		->label(''.$music->sokial('U07').'')
		->required();
$upload->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$upload->bound($_POST);

if($upload->is_valid($_POST)) {

	list($category, $type, $url, $privacy) = $upload->get_cleaned_data('category', 'type', 'url', 'privacy');

	switch($type) {
		case 'SoundCloud':
			$xml = soundcloud($url);
			$title = $xml->title;
			$thumb = SK_IMG.'soundcloud.png';
			$embed = $xml->html;
			break;
		case 'Mixcloud':
			$xml = mixcloud($url);
			$title = $xml->title;
			$thumb = 'http:'.$xml->image;
			$embed = '<iframe width="750" height="180" src="//www.mixcloud.com/widget/iframe/?feed='.$url.'&amp;replace=0&amp;hide_cover=1&amp;embed_type=widget_standard&amp;hide_tracklist=0" frameborder="0"></iframe>';
			break;
		default:
			$title = '';
			$thumb = '';
			$embed = '';
			break;
	}

	$last = last_id_music();
	$last_id = $last->id_music+1;
	add_music($_SESSION['sk_id'], $category, $type, $url, $thumb, $title, $embed, $privacy);
	feed_add_music($_SESSION['sk_id'], $last_id);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'musik/'.$last_id.'\');",2.0) </script>';

}

include SK_VIEW.FILE;

include 'footer.php';

?>