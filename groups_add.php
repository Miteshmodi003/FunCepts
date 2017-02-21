<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 05.09.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$group = new Languages('groups');

$y = SokialDB::getInstance();

$add = new Form('add_group', 'POST');
$add->action('');
$add->add('Text', 'name')
		->label(''.$group->sokial('O01').'')
		->required();
$categories = array();
foreach($y->query("SELECT id_cat,name FROM groups_cat ORDER BY id_cat ASC") as $cat) {
	$categories[$cat['id_cat']] = $cat['name'];
}
$add->add('Select', 'category')
		->choices($categories)
		->value('1')
		->label(''.$form->sokial('F17').'');
$add->add('Select', 'privacy')
		->choices(array(
           '1' => $form->sokial('F18'),
           '2' => $form->sokial('F19'),
           '3' => $form->sokial('F20'),
           '4' => $form->sokial('F21')
         ))
		->value('1')
		->label(''.$group->sokial('O02').'');
$add->add('Textarea', 'description')
		->label(''.$group->sokial('O03').'')
		->required();
$add->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$add->bound($_POST);

if($add->is_valid($_POST)) {

	list($name, $category, $privacy, $description) = $add->get_cleaned_data('name', 'category', 'privacy', 'description');

	add_group($_SESSION['sk_id'], $category, $name, $description, $privacy);

	$last = last_id_group();

	feed_add_group($_SESSION['sk_id'], $last->id_group);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'groups_photo.php?id='.$last->id_group.'\');",2.0) </script>';

}

include SK_VIEW.FILE;

include 'footer.php';

?>