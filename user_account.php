<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 28.08.15
// Version 3.0.5

include 'header.php';

access_member();

$general = new Languages('general');
$form = new Languages('form');

$y = SokialDB::getInstance();

$account = new Form('account', 'POST');
$account->action('');
$account->add('Text', 'firstname')
		->label(''.$form->sokial('F08').'')
		->value($user->firstname)
		->required();
$account->add('Text', 'lastname')
		->label(''.$form->sokial('F07').'')
		->value($user->lastname)
		->required();
$account->add('Text', 'email')
		->label(''.$form->sokial('F01').'')
		->value($user->email)
		->required();
$account->add('Select', 'sex')
		->choices(array(
           '1' => $form->sokial('F10'),
           '2' => $form->sokial('F11')
         ))
		->value($user->sex)
		->label(''.$form->sokial('F09').'');
$country = array();
foreach($y->query("SELECT code,name_country FROM country ORDER BY name_country ASC") as $cnt) {
	$country[$cnt['code']] = $cnt['name_country'];
}
$account->add('Select', 'country')
		->choices($country)
		->value($user->country)
		->label(''.$form->sokial('F12').'');
$account->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$account->bound($_POST);

if($account->is_valid($_POST)) {

	list($firstname, $lastname, $email, $sex, $country) =
		$account->get_cleaned_data('firstname', 'lastname', 'email', 'sex', 'country');

	up_infos_member($user->id_user,$firstname,$lastname,$email,$sex,$country);

	$success = $form->sokial('F22');

}

include SK_VIEW.FILE;

include 'footer.php';

?>