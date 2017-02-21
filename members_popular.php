<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 29.10.15
// Version 3.0.5

include 'header.php';

access_member();

$members = new Languages('members');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$users = list_popular_members($page,$set->page_members);
$nb_user = members_number();

$nbr_member = $nb_user->n_users;

$nb_pages = ceil($nbr_member / $set->page_members);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

include SK_VIEW.FILE;

include 'footer.php';

?>