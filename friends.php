<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 25.10.15
// Version 3.0.5

include 'header.php';
require(CORE.'Feeds.php');

access_member();

$members = new Languages('members');
up_notifs_friends($user->id_user);

$nf_friends = number_friends($user->id_user);

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$users = list_friends($page,$set->page_friends,$user->id_user);

$nbr_friends = $nf_friends->nf_friend;

$nb_pages = ceil($nbr_friends / $set->page_friends);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

switch ($nf_friends->nf_friend) {
	case 0:
		$friends = '<div class="no_results">'.$members->sokial('M22').'</div>';
		break;
	default:
		$friends = $users;
		break;
}

$pending_request = list_notifs_friends($user->id_user);

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['accept'])){
	up_accept_friend($_POST['accept']);
	feed_add_friend($_SESSION['sk_id'], $_POST['friend_id']);
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'friends\');",2.0) </script>';
}

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['refuse'])){
	$db = SokialDB::getInstance();
	$db->exec("DELETE FROM friends WHERE id_friend = '".$_POST['refuse']."' ");
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'friends\');",2.0) </script>';
}

include SK_VIEW.FILE;

include 'footer.php';

?>