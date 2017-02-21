<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 18.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_user = $_GET['id'];
$user = new Languages('members');

$member = member_info($id_user);
$avatar = member_photo($id_user);
$country = country($member->country);
$session = last_session_member($id_user);
$time = duration($session->TimeSession);
$total_message = number_user_messages($id_user);
$total_friends = number_user_friends($id_user);
$total_photos = number_user_photos($id_user);
$total_videos = number_user_videos($id_user);
$total_music = number_user_music($id_user);
$total_blogs = number_user_blogs($id_user);
$total_replies = number_user_replies($id_user);
$total_events = number_user_events($id_user);
$total_groups = number_user_groups($id_user);

switch($avatar->file) {
    case '':
        $photo = 'files/users/150x_nophoto.gif';
        break;
    default:
        $photo = $avatar->file;
        break;
}

switch($member->sex) {
    case '1':
        $sex = $user->sokial('M10');
        break;
    default:
        $sex = $user->sokial('M11');
        break;
}

if($_POST['id_user']){
    $db = SokialDB::getInstance();
    $id_user = $_POST['id_user'];
    $db->exec("DELETE FROM users WHERE id_user = $id_user");
    $success = $user->sokial('M38');
    echo '<meta http-equiv="refresh" content="1;URL=members.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>