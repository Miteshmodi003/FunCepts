<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_user = $_GET['id'];
$user = new Languages('members');

$view = admin_info($id_user);

include SK_VIEW.FILE;

include 'footer.php';

?>