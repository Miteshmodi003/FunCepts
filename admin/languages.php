<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 02.01.15
// Version 3.0.6

include 'header.php';

access_admin();

$languages = languages_edit();

include SK_VIEW.FILE;

include 'footer.php';

?>