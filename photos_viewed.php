<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

$photo = new Languages('photos');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$photos = list_photos_viewed($page,$set->page_photos);
$nb_photo = photos_number();

$nbr_photo = $nb_photo->n_photos;

$photos = $nbr_photo != 0 ? $photos : $photo->sokial('P05');

$nb_pages = ceil($nbr_photo / $set->page_photos);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

include SK_VIEW.FILE;

include 'footer.php';

?>