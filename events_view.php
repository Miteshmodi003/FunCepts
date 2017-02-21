<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 27.10.15
// Version 3.0.5

include 'header.php';
require(CORE.'Feeds.php');

access_member();

$id_event = $_GET['id'];

$members = new Languages('members');
$evnt = new Languages('events');

$event = event_info($_GET['id']);
$country = country($event->country);
$nb_going = number_going_event($id_event);

$items_per_group = 9;
$db = SokialDB::getInstance();
$mf = $db->query("SELECT COUNT(id_feed) as f_records FROM feeds WHERE user_id = $id_event");
$mf->execute();
$setf=$mf->fetch(PDO::FETCH_OBJ);
$total_groups = ceil($setf->f_records/$items_per_group);

$go = $db->prepare("SELECT user_id,event_id FROM events_going WHERE user_id = :user_id AND event_id = :event_id ");
$go->bindValue(':user_id',$_SESSION['sk_id'],PDO::PARAM_INT);
$go->bindValue(':event_id',$event->id_event,PDO::PARAM_INT);
$go->execute();
$nbr_go = $go->rowCount();

switch($nbr_go) {
	case 0:
		$going = '<a href="" title="" class="sk-bubble btn_profil going" name="going_event" id="'.$event->id_event.'" sokial="'.$evnt->sokial('E13').'"><i class="fa fa-bicycle"></i></a>';
		break;
	default:
		$going = '<a href="" title="" class="sk-bubble btn_profil going" id="'.$event->id_event.'" sokial="'.$evnt->sokial('E14').'"><i class="fa fa-briefcase"></i></a>';
		break;
}

$going_users = list_going($id_event);

switch($user->id_user) {
	case $event->user_id:
		$message = '';
		break;
	default:
		$message = '<a href="#" title="" data-width="500" data-rel="SendMessage" class="sk-bubble btn_profil poplight" rel="popup_name" sokial="'.$members->sokial('M10').'"><i class="fa fa-comments-o"></i></a>';
		break;
}

// Message //

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $mec = $db->query("SELECT sender,receiver FROM messages WHERE (sender = $event->user_id AND receiver = $user->id_user) OR (receiver = $event->user_id AND sender = $user->id_user)");
	$mec->setFetchMode(PDO::FETCH_OBJ);
	$nbr_conv = $mec->rowCount();
	if($nbr_conv == 0){
		send_message($user->id_user, $event->user_id);
		$last = last_id_message($user->id_user, $event->user_id);
		send_message_reply($last->id_message, $user->id_user, $event->user_id, $_POST['message']);
	}elseif($nbr_conv > 0){
		$last = last_id_message($user->id_user, $event->user_id);
		send_message_reply($last->id_message, $user->id_user, $event->user_id, $_POST['message']);
	}
	$success = $members->sokial('M13');
}

include SK_VIEW.FILE;

include 'footer.php';

?>