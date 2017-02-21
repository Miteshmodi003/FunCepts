<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_game = $_GET['id'];
$user = new Languages('members');
$game = new Languages('games');
$video = new Languages('videos');
$view = game_info($id_game);
$cat = cat_game($view->cat_id);

if($_POST['id_game']){
    $db = SokialDB::getInstance();
    $id_game = $_POST['id_game'];
    $db->exec("DELETE FROM games WHERE id_game = $id_game");
    $success = $game->sokial('A08');
    echo '<meta http-equiv="refresh" content="1;URL=games.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>