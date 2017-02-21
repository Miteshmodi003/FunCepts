<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$forum = new Languages('forum');

$y = SokialDB::getInstance();

$add = new Form('addTopic', 'POST');
$add->action('');
$add->add('Text', 'title')
		->label(''.$forum->sokial('R01').'')
		->required();
$add->add('Select', 'privacy')
		->choices(array(
           '1' => $form->sokial('F18'),
           '2' => $form->sokial('F19'),
           '3' => $form->sokial('F20'),
           '4' => $form->sokial('F21')
         ))
		->value('1')
		->label(''.$forum->sokial('R02').'');
$categories = array();
foreach($y->query("SELECT id_cat,forum_id,name FROM forum_cat ORDER BY id_cat ASC") as $cat) {
	$categories[$cat['id_cat']] = $cat['name'];
}
$add->add('Select', 'category')
		->choices($categories)
		->value('1')
		->label(''.$form->sokial('F17').'');
$add->add('Textarea', 'details')
		->label(''.$forum->sokial('R03').'')
		->required();
$add->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$add->bound($_POST);

if($add->is_valid($_POST)) {

	list($category, $title, $details, $privacy) = $add->get_cleaned_data('category', 'title', 'details', 'privacy');
	$catg = infos_cat_forum($category);
	add_topic($_SESSION['sk_id'], $catg->forum_id, $category, $title, $details, $privacy);

	$last = last_id_topic();
	feed_add_topic($_SESSION['sk_id'], $last->id_topic);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'topic/'.$last->id_topic.'\');",2.0) </script>';

}

include SK_VIEW.FILE;

include 'footer.php';

?>