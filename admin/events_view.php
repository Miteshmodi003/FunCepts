<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_event = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$event = new Languages('events');
$view = event_info($id_event);
$cat = cat_event($view->cat_id);
$country = country($view->country);
$total_going = going_events_number($id_event);

$time = duration($view->TimeEvent);

if($_POST['id_event']){
    $db = SokialDB::getInstance();
    $id_event = $_POST['id_event'];
    $db->exec("DELETE FROM events WHERE id_event = $id_event");
    $success = $event->sokial('E14');
    echo '<meta http-equiv="refresh" content="1;URL=events.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>