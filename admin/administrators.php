<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$admin = new Languages('admin');

$total_admin = admin_number();
$total_pages = ceil($total_admin/11);

include SK_VIEW.FILE;

include 'footer.php';

?>