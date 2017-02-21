<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$game = new Languages('games');

$total_game = games_number();
$total_pages = ceil($total_game/11);

include SK_VIEW.FILE;

include 'footer.php';

?>