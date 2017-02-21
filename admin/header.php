<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

session_start();

include_once 'core/Settings.php';

$general = new Languages('general');

$page = basename($_SERVER['PHP_SELF']);
$select = ' class="menu_active_item"';

switch($page) {
    case 'home.php':
        $ska1 = $select;
        break;
    default:
        $ska1 = '';
        break;
}
switch($page) {
    case 'members.php':
    case 'members_view.php':
    case 'members_update.php':
    case 'members_messages.php':
    case 'members_friends.php':
    case 'members_photos.php':
    case 'members_videos.php':
    case 'members_music.php':
    case 'members_blogs.php':
    case 'members_forum.php':
    case 'members_events.php':
    case 'members_groups.php':
        $ska2 = $select;
        break;
    default:
        $ska2 = '';
        break;
}
switch($page) {
    case 'photos.php':
    case 'photos_view.php':
    case 'videos.php':
    case 'videos_view.php':
    case 'music.php':
    case 'music_view.php':
    case 'blogs.php':
    case 'blogs_view.php':
    case 'forum.php':
    case 'forum_view.php':
    case 'events.php':
    case 'events_view.php':
    case 'groups.php':
    case 'groups_view.php':
    case 'games.php':
    case 'games_view.php':
        $ska3 = $select;
        break;
    default:
        $ska3 = '';
        break;
}
switch($page) {
    case 'stats_geo.php':
    case 'stats_referer.php':
    case 'stats_os.php':
    case 'stats_browser.php':
    case 'stats_screen.php':
    case 'stats_pages.php':
        $ska4 = $select;
        break;
    default:
        $ska4 = '';
        break;
}
switch($page) {
    case 'template_settings.php':
    case 'template_theme.php':
    case 'template_responsive.php':
        $ska5 = $select;
        break;
    default:
        $ska5 = '';
        break;
}
switch($page) {
    case 'settings.php':
    case 'administrators.php':
    case 'administrators_view.php':
    case 'server.php':
        $ska6 = $select;
        break;
    default:
        $ska6 = '';
        break;
}
switch($page) {
    case 'languages.php':
    case 'languages_choice.php':
    case 'languages_edit.php':
        $ska7 = $select;
        break;
    default:
        $ska7 = '';
        break;
}
switch($page) {
    case 'encryption_password.php':
    case 'bruteforce.php':
    case 'antivirus.php':
        $ska8 = $select;
        break;
    default:
        $ska8 = '';
        break;
}

include SK_VIEW.'header.php';

?>