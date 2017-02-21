<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

$music = new Languages('music');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$musics = list_musics($page,$set->page_music);
$nb_music = musics_number();

$nbr_music = $nb_music->n_musics;

$musics = $nbr_music != 0 ? $musics : 'No music';

$nb_pages = ceil($nbr_music / $set->page_music);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

$page_music = basename($_SERVER['PHP_SELF']);
$act_music = ' class="active"';

include SK_VIEW.FILE;

include 'footer.php';

?>