<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include 'header.php';
include_once '../core/Form.php';

$current_lang = !empty($_SESSION['language_admin']) ? current_languages($_SESSION['language_admin']) : current_languages(SK_LANG);

$languages = languages();

$form = new Languages('form');

$login = new Form('connection', 'POST');

$login->action('');
$login->add('Text', 'email')
            ->value(''.$general->sokial('G05').'')
            ->required();
$login->add('Password', 'password')
            ->required();
$login->add('Submit', 'submit')
            ->value(''.$form->sokial('O01').'')
            ->add_class('btn btn_blue button');
$login->bound($_POST);

$errors = array();

if($login->is_valid($_POST)) {

    list($email, $password) = $login->get_cleaned_data('email', 'password');

    $id_admin = valid_connection_admin($email, sha1($password.md5(SK_KEY)));
    $caid = session_admin($email);

    if(false !== $id_admin) {

        $_SESSION['sk_admin'] = $caid->id_admin;
        $_SESSION['email'] = $email;

        up_last_login($_SESSION['sk_admin']);

        echo '<script>location.replace("home.php");</script>';

    } else {
        $errors[] = $form->sokial('O02');
    }
    
}

include SK_VIEW.FILE;

?>