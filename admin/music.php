<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 14.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$music = new Languages('music');

$total_music = music_number();
$total_pages = ceil($total_music/11);

include SK_VIEW.FILE;

include 'footer.php';

?>