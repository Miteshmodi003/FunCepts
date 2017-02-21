<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_video = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$video = new Languages('videos');
$view = video_info($id_video);
$cat = cat_video($view->cat_id);

$time = duration($view->TimeVideo);

if($_POST['id_video']){
    $db = SokialDB::getInstance();
    $id_video = $_POST['id_video'];
    $db->exec("DELETE FROM videos WHERE id_video = $id_video");
    $success = $video->sokial('V11');
    echo '<meta http-equiv="refresh" content="1;URL=videos.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>