<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 14.08.15
// Version 3.0.5

include 'header.php';

access_member();

$photo = new Languages('photos');

$style = photo_info($_GET['id']);

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	uptade_style($_GET['id'], $_POST['style_photo']);
	echo '<meta http-equiv="refresh" content="1; URL=photo/'.$_GET['id'].'">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>