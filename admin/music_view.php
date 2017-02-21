<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_music = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$video = new Languages('videos');
$music = new Languages('music');

$view = music_info($id_music);
$cat = cat_music($view->cat_id);

$time = duration($view->TimeMusic);

if($_POST['id_music']){
    $db = SokialDB::getInstance();
    $id_music = $_POST['id_music'];
    $db->exec("DELETE FROM music WHERE id_music = $id_music");
    $success = $music->sokial('S09');
    echo '<meta http-equiv="refresh" content="1;URL=music.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>