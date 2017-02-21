<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

$forum = list_topics_user($user->id_user);
$fofo = new Languages('forum');

include SK_VIEW.FILE;

include 'footer.php';

?>