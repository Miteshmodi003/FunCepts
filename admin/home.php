<?php

include 'header.php';
include CORE.'Statistics.php';

access_admin();

$home = new Languages('home');

$cpuload = new CPULoad();
$cpuload->get_load();

$members = members_home();
$daily_visitor = daily_visitor();
$daily_registration = daily_registration();
$daily_connection = daily_connection();
$yesterday_visitor = yesterday_visitor();
$yesterday_registration = yesterday_registration();
$yesterday_connection = yesterday_connection();
$before_yesterday_visitor = before_yesterday_visitor(2);
$before_yesterday_registration = before_yesterday_registration(2);
$before_yesterday_connection = before_yesterday_connection(2);
$day1_before_yesterday_visitor = before_yesterday_visitor(3);
$day1_before_yesterday_registration = before_yesterday_registration(3);
$day1_before_yesterday_connection = before_yesterday_connection(3);
$day2_before_yesterday_visitor = before_yesterday_visitor(4);
$day2_before_yesterday_registration = before_yesterday_registration(4);
$day2_before_yesterday_connection = before_yesterday_connection(4);
$day3_before_yesterday_visitor = before_yesterday_visitor(5);
$day3_before_yesterday_registration = before_yesterday_registration(5);
$day3_before_yesterday_connection = before_yesterday_connection(5);
$day4_before_yesterday_visitor = before_yesterday_visitor(6);
$day4_before_yesterday_registration = before_yesterday_registration(6);
$day4_before_yesterday_connection = before_yesterday_connection(6);
$day5_before_yesterday_visitor = before_yesterday_visitor(7);
$day5_before_yesterday_registration = before_yesterday_registration(7);
$day5_before_yesterday_connection = before_yesterday_connection(7);
$total_user = members_number();
$total_man = number_man();
$total_woman = number_woman();
$total_online = number_online();
$total_offline = number_offline();
$total_photo = photos_number();
$total_video = videos_number();
$total_music = music_number();
$total_blog = blogs_number();
$total_photo_commented = number_photos_commented();
$total_photo_shared = number_photos_shared();
$total_video_commented = number_videos_commented();
$total_video_shared = number_videos_shared();
$total_music_commented = number_musics_commented();
$total_music_shared = number_musics_shared();
$total_blog_commented = number_blogs_commented();
$total_blog_shared = number_blogs_shared();
$percentage_man = round(percentage($total_man, $total_user),0);
$percentage_woman = round(percentage($total_woman, $total_user),0);
$percentage_online = round(percentage($total_online, $total_user),0);
$percentage_offline = round(percentage($total_offline, $total_user),0);

if ($total_photo_commented > 0) {
    $percentage_photo_commented = round(percentage($total_photo_commented, $total_photo),0);
}else{
    $percentage_photo_commented = '0';
}

if ($total_photo_shared > 0) {
    $percentage_photo_shared = round(percentage($total_photo_shared, $total_photo),0);
}else{
    $percentage_photo_shared = '0';
}

if ($total_video_commented > 0) {
    $percentage_video_commented = round(percentage($total_video_commented, $total_video),0);
}else{
    $percentage_video_commented = '0';
}

if ($total_video_shared > 0) {
    $percentage_video_shared = round(percentage($total_video_shared, $total_video),0);
}else{
    $percentage_video_shared = '0';
}

if ($total_music_commented > 0) {
    $percentage_music_commented = round(percentage($total_music_commented, $total_music),0);
}else{
    $percentage_music_commented = '0';
}

if ($total_music_shared > 0) {
    $percentage_music_shared = round(percentage($total_music_shared, $total_music),0);
}else{
    $percentage_music_shared = '0';
}

if ($total_blog_commented > 0) {
    $percentage_blog_commented = round(percentage($total_blog_commented, $total_blog),0);
}else{
    $percentage_blog_commented = '0';
}

if ($total_blog_shared > 0) {
    $percentage_blog_shared = round(percentage($total_blog_shared, $total_blog),0);
}else{
    $percentage_blog_shared = '0';
}

switch($_SESSION['language_admin']) {
    case 'fr':
        $date_today = date("j F Y");
        $date_yesterday = date('j F Y',(time() - 86400));
        $before_date_yesterday = date('j F Y',(time() - 172800));
        $day1_before_date_yesterday = date('j F Y',(time() - 259200));
        $day2_before_date_yesterday = date('j F Y',(time() - 345600));
        $day3_before_date_yesterday = date('j F Y',(time() - 432000));
        $day4_before_date_yesterday = date('j F Y',(time() - 518400));
        $day5_before_date_yesterday = date('j F Y',(time() - 604800));
        break;
    case 'en':
        $date_today = date("F j, Y");
        $date_yesterday = date('F j, Y',(time() - 86400));
        $before_date_yesterday = date('F j, Y',(time() - 172800));
        $day1_before_date_yesterday = date('F j, Y',(time() - 259200));
        $day2_before_date_yesterday = date('F j, Y',(time() - 345600));
        $day3_before_date_yesterday = date('F j, Y',(time() - 432000));
        $day4_before_date_yesterday = date('F j, Y',(time() - 518400));
        $day5_before_date_yesterday = date('F j, Y',(time() - 604800));
        break;
    default:
        $date_today = date("F j, Y");
        $date_yesterday = date('F j, Y',(time() - 86400));
        $before_date_yesterday = date('F j, Y',(time() - 172800));
        $day1_before_date_yesterday = date('F j, Y',(time() - 259200));
        $day2_before_date_yesterday = date('F j, Y',(time() - 345600));
        $day3_before_date_yesterday = date('F j, Y',(time() - 432000));
        $day4_before_date_yesterday = date('F j, Y',(time() - 518400));
        $day5_before_date_yesterday = date('F j, Y',(time() - 604800));
        break;
}

if ($daily_visitor > $yesterday_visitor) {
    $variation_daily_visitor = '<span class="number_most">'.$daily_visitor.' <i class="fa fa-angle-double-up"></i></span>';
}elseif ($daily_visitor < $yesterday_visitor) {
    $variation_daily_visitor = '<span class="number_less">'.$daily_visitor.' <i class="fa fa-angle-double-down"></i></span>';
}elseif ($daily_visitor == $yesterday_visitor) {
    $variation_daily_visitor = '<span class="number_neutral">'.$daily_visitor.' -</span>';
}

if ($daily_registration > $yesterday_registration) {
    $variation_daily_registration = '<span class="number_most">'.$daily_registration.' <i class="fa fa-angle-double-up"></i></span>';
}elseif ($daily_registration < $yesterday_registration) {
    $variation_daily_registration = '<span class="number_less">'.$daily_registration.' <i class="fa fa-angle-double-down"></i></span>';
}elseif ($daily_registration == $yesterday_registration) {
    $variation_daily_registration = '<span class="number_neutral">'.$daily_registration.' -</span>';
}

if ($daily_connection > $yesterday_connection) {
    $variation_daily_connection = '<span class="number_most">'.$daily_connection.' <i class="fa fa-angle-double-up"></i></span>';
}elseif ($daily_connection < $yesterday_connection) {
    $variation_daily_connection = '<span class="number_less">'.$daily_connection.' <i class="fa fa-angle-double-down"></i></span>';
}elseif ($daily_connection == $yesterday_connection) {
    $variation_daily_connection = '<span class="number_neutral">'.$daily_connection.' -</span>';
}

$daily_visitor_prevision = round($daily_visitor + ($yesterday_visitor * 20 / 100),0);
$daily_registration_prevision = round($daily_registration + ($yesterday_registration * 20 / 100),0);
$daily_connection_prevision = round($daily_connection + ($yesterday_connection * 20 / 100),0);

include SK_VIEW.FILE;

include 'footer.php';

?>