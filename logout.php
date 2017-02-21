<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 25.10.15
// Version 3.0.5

include 'core/Settings.php';

up_logout($_SESSION['sk_id']);

$signout = new logout();
$signout->logout();

header('Location: index.php');

?>