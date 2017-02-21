<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 31.12.15
// Version 3.0.6

include 'header.php';
include CORE.'Template.php';

access_admin();

$languages = languages_admin();
$temp = template_settings(1);

$template = new Languages('template');

include SK_VIEW.FILE;

include 'footer.php';

?>