<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');

$total_user = members_number();
$total_pages = ceil($total_user/11);

include SK_VIEW.FILE;

include 'footer.php';

?>