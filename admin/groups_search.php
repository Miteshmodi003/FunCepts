<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include_once 'core/Settings.php';

if (isset($_POST['partialState'])) {
	$groups = list_groups_search($_POST['partialState']);
	echo $groups;
}

?>