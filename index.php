<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 01.01.15
// Version 3.0.5

include 'header.php';

$index = new Languages('index');
$form = new Languages('form');

$set->back_active == 1 ? $background = $set->background : $background = '';

$connection = new Form('connection', 'POST');

$connection->action('');
$connection->add('Text', 'email')
            ->value(''.$form->sokial('F01').'')
            ->required();
$connection->add('Password', 'password')
            ->required();
$connection->add('Submit', 'submit')
            ->value(''.$form->sokial('F03').'')
            ->add_class('btn btn_blue');
$connection->bound($_POST);

$errors = array();

if($connection->is_valid($_POST)) {

    list($email, $password) = $connection->get_cleaned_data('email', 'password');

    $id_user = valid_connection($email, sha1($password.md5(SK_KEY)));
    $coid = session_member($email);

    if(false !== $id_user) {

        $_SESSION['sk_id'] = $coid->id_user;
        $_SESSION['email'] = $email;
        up_online($_SESSION['sk_id']);
        up_os($_SESSION['sk_id'], getOS());
        add_sessions($_SESSION['sk_id']);

        echo '<meta http-equiv="refresh" content="0;URL=home">';

    } else {
        $errors[] = $form->sokial('F14');
        up_error_login($_POST['email']);
    }
    
}

include SK_VIEW.FILE;

include 'footer.php';

?>