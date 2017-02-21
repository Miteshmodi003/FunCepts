<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$video = new Languages('videos');

include SK_VIEW.FILE;

include 'footer.php';

?>