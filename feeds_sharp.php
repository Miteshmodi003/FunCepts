<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 30.11.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

$feeds = feeds_sharp($_GET['id']);

echo $feeds;

?>