<?php

session_start();

include_once 'core/Settings.php';

if($_POST['id']){

	$db = SokialDB::getInstance();

	$db->exec("DELETE FROM feeds_likes WHERE feed_id = '".$_POST['id']."' ");
	$db->exec("DELETE FROM feeds_comments WHERE feed_id = '".$_POST['id']."' ");
	$db->exec("DELETE FROM feeds WHERE id_feed = '".$_POST['id']."' ");
}

?>