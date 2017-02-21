<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.12.15
// Version 3.0.6

include_once 'core/Settings.php';

if (isset($_POST['partialState'])) {
	$users = list_members_search($_POST['partialState']);
	echo $users;
}

?>