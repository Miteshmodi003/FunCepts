<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 14.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');

$total_photo = photos_number();
$total_pages = ceil($total_photo/11);

include SK_VIEW.FILE;

include 'footer.php';

?>