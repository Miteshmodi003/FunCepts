<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.10.15
// Version 3.0.5

include 'header.php';

access_member();

$blog = new Languages('blogs');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$blogs = list_blogs($page,$set->page_blogs);
$nb_blog = blogs_number();

$nbr_blog = $nb_blog->n_blogs;

$blogs = $nbr_blog != 0 ? $blogs : $blog->sokial('B07');

$nb_pages = ceil($nbr_blog / $set->page_blogs);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

include SK_VIEW.FILE;

include 'footer.php';

?>