<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include_once 'core/Settings.php';

require_once(CORE.'Administrators.php');

$signout_admin = new logout_admin();
$signout_admin->logout_admin();

header('Location: index.php');

?>