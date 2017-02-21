<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.08.15
// Version 3.0.5

include 'header.php';

access_member();

$users = list_members_search($_POST['search']);
$photos = list_photos_search($_POST['search']);
$videos = list_videos_search($_POST['search']);
$musics = list_musics_search($_POST['search']);

include SK_VIEW.FILE;

include 'footer.php';

?>