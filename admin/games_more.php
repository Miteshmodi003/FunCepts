<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include_once 'core/Settings.php';

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

$item_per_page = 11;

$position = ($page_number * $item_per_page);

$games = list_games_more($position,$item_per_page);
echo $games;

?>