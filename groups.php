<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 05.09.15
// Version 3.0.5

include 'header.php';

access_member();

$group = new Languages('groups');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$groups = list_groups($page,$set->page_groups);
$nb_group = groups_number();

$nbr_group = $nb_group->n_groups;

$groups = $nbr_group != 0 ? $groups : 'No groups';

$nb_pages = ceil($nbr_group / $set->page_groups);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

include SK_VIEW.FILE;

include 'footer.php';

?>