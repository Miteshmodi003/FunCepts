<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 01.01.15
// Version 3.0.6

include 'header.php';
include CORE.'Template.php';

access_admin();

$languages = languages_admin();
$temp = template_settings(1);

$template = new Languages('template');

$width = $_GET['w'];
$height = $_GET['h'];

$frame_width = $width-40;
$frame_height = $height-40;

include SK_VIEW.FILE;

include 'footer.php';

?>