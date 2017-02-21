<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_photo = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');

$view = photo_info($id_photo);
$file = explode("300_", $view->file);
$time = duration($view->TimePhoto);
$size = number_format($view->size/1024, 2);
$extension = substr($file[1], 11);

if($_POST['id_photo']){
    $db = SokialDB::getInstance();
    $id_photo = $_POST['id_photo'];
    $db->exec("DELETE FROM photos WHERE id_photo = $id_photo");
    $success = $picture->sokial('P25');
    echo '<meta http-equiv="refresh" content="1;URL=photos.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>