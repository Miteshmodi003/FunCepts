<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$group = new Languages('groups');

$total_group = groups_number();
$total_pages = ceil($total_group/11);

include SK_VIEW.FILE;

include 'footer.php';

?>