<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 25.10.15
// Version 3.0.5

include 'header.php';

access_member();

$members = new Languages('members');

include SK_VIEW.FILE;

include 'footer.php';

?>