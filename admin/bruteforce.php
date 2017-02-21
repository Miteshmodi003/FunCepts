<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 01.01.15
// Version 3.0.6

include 'header.php';
include CORE.'Template.php';

access_admin();

$user = new Languages('members');

$errors = list_errors_login();

include SK_VIEW.FILE;

include 'footer.php';

?>