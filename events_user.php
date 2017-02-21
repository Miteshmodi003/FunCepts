<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 26.10.15
// Version 3.0.5

include 'header.php';

access_member();

$event = new Languages('events');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$events = list_events_user($page,$set->page_events,$user->id_user);
$nb_event = events_number_user($user->id_user);

$nbr_event = $nb_event->n_events;

$events = $nbr_event != 0 ? $events : 'No events';

$nb_pages = ceil($nbr_event / $set->page_events);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

include SK_VIEW.'events.php';

include 'footer.php';

?>