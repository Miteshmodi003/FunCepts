<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_user = $_GET['id'];
$user = new Languages('members');

$member = member_info($id_user);

$total_message = number_user_messages($id_user);
$total_friends = number_user_friends($id_user);
$total_photos = number_user_photos($id_user);
$total_videos = number_user_videos($id_user);
$total_music = number_user_music($id_user);
$total_blogs = number_user_blogs($id_user);
$total_replies = number_user_replies($id_user);
$total_events = number_user_events($id_user);
$total_groups = number_user_groups($id_user);

$blogs = members_blogs($id_user);

include SK_VIEW.FILE;

include 'footer.php';

?>