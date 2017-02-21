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

$events = list_events($page,$set->page_events);
$nb_event = events_number();

$nbr_event = $nb_event->n_events;

$events = $nbr_event != 0 ? $events : 'No events';

$nb_pages = ceil($nbr_event / $set->page_events);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

$page_event = basename($_SERVER['PHP_SELF']);
$act_event = ' class="active"';

switch($page_event) {
	case 'events.php':
		$ep1 = $act_event;
		break;
	default:
		$ep1 = '';
		break;
}

switch($page_event) {
	case 'events_user.php':
		$ep2 = $act_event;
		break;
	default:
		$ep2 = '';
		break;
}

include SK_VIEW.FILE;

include 'footer.php';

?>