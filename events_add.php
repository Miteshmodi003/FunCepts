<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 27.10.15
// Version 3.0.5

include 'header.php';

access_member();

$form = new Languages('form');
$event = new Languages('events');

$y = SokialDB::getInstance();

$add = new Form('addEvent', 'POST');
$add->action('');
$add->add('Text', 'title')
		->label(''.$event->sokial('E01').'')
		->required();
$add->add('Select', 'privacy')
		->choices(array(
           '1' => $form->sokial('F18'),
           '2' => $form->sokial('F19'),
           '3' => $form->sokial('F20'),
           '4' => $form->sokial('F21')
         ))
		->value('1')
		->label(''.$event->sokial('E02').'');
$add->add('Text', 'address')
		->label(''.$event->sokial('E03').'')
		->required();
$add->add('Text', 'city')
		->label(''.$event->sokial('E04').'')
		->required();
$country = array();
foreach($y->query("SELECT code,name_country FROM country ORDER BY name_country ASC") as $cnt) {
	$country[$cnt['code']] = $cnt['name_country'];
}
$add->add('Select', 'country')
		->choices($country)
		->value('BZH')
		->label(''.$form->sokial('F12').'');
$add->add('Text', 'date')
		->label(''.$event->sokial('E05').'')
		->required();
$add->add('Text', 'end')
		->label(''.$event->sokial('E19').'')
		->required();
$categories = array();
foreach($y->query("SELECT id_cat,name FROM events_cat ORDER BY id_cat ASC") as $cat) {
	$categories[$cat['id_cat']] = $cat['name'];
}
$add->add('Select', 'category')
		->choices($categories)
		->value('1')
		->label(''.$form->sokial('F17').'');
$add->add('Textarea', 'details')
		->label(''.$event->sokial('E06').'')
		->required();
$add->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$add->bound($_POST);

if($add->is_valid($_POST)) {

	list($title, $privacy, $address, $city, $country, $date, $end, $category, $details) = $add->get_cleaned_data('title', 'privacy', 'address', 'city', 'country', 'date', 'end', 'category', 'details');

	add_event($_SESSION['sk_id'], $title, $privacy, $address, $city, $country, $date, $end, $category, $details);
	$last = last_id_event();
	feed_add_event($_SESSION['sk_id'], $last->id_event);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'event/'.$last->id_event.'\');",2.0) </script>';

}

include SK_VIEW.FILE;

include 'footer.php';

?>