<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 16.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$blog = new Languages('blogs');

$total_blog = blogs_number();
$total_pages = ceil($total_blog/11);

include SK_VIEW.FILE;

include 'footer.php';

?>