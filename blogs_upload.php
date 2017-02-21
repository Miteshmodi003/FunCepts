<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.10.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$blog = new Languages('blogs');

$y = SokialDB::getInstance();

$upload = new Form('upload', 'POST');
$upload->action('');
$upload->add('Text', 'title')
		->label(''.$blog->sokial('B03').'')
		->required();
$categories = array();
foreach($y->query("SELECT id_cat,name FROM blogs_cat ORDER BY id_cat ASC") as $cat) {
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
		->label(''.$blog->sokial('B04').'');
$upload->add('Textarea', 'description')
		->label(''.$blog->sokial('B05').'')
		->required();
$upload->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$upload->bound($_POST);

if($upload->is_valid($_POST)) {

	list($title, $category, $privacy, $description) = $upload->get_cleaned_data('title', 'category', 'privacy', 'description');

	$last = last_id_blog();
	$last_id = $last->id_blog+1;
	add_blog($_SESSION['sk_id'], $category, $title, $description, $privacy);
	feed_add_blog($_SESSION['sk_id'], $last_id);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'blog/'.$last_id.'\');",2.0) </script>';

}

include SK_VIEW.FILE;

include 'footer.php';

?>