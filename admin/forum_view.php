<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_reply = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$forum = new Languages('forum');
$view = forum_reply_info($id_reply);
$cat = cat_forum($view->cat_id);
$topic = topic_forum($view->topic_id);

$time = duration($view->TimeReply);

if($_POST['id_reply']){
    $db = SokialDB::getInstance();
    $id_reply = $_POST['id_reply'];
    $db->exec("DELETE FROM forum_topics_reply WHERE id_reply = $id_reply");
    $success = $forum->sokial('F09');
    echo '<meta http-equiv="refresh" content="1;URL=forum.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>