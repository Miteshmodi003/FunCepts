<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$languages = languages_admin();

$form = new Languages('form');

if(isset($_POST) && isset($_POST['domaine']) && isset($_POST['name_site']) && isset($_POST['email_site'])){
    if(get_magic_quotes_gpc()){
        $_POST['domaine'] = stripslashes(trim($_POST['domaine']));
        $_POST['name_site'] = stripslashes(trim($_POST['name_site']));
        $_POST['email_site'] = stripslashes(trim($_POST['email_site']));
        $_POST['template'] = stripslashes(trim($_POST['template']));
        $_POST['sk_key'] = stripslashes(trim($_POST['sk_key']));
        $_POST['page_members'] = stripslashes(trim($_POST['page_members']));
        $_POST['page_photos'] = stripslashes(trim($_POST['page_photos']));
        $_POST['page_videos'] = stripslashes(trim($_POST['page_videos']));
        $_POST['page_music'] = stripslashes(trim($_POST['page_music']));
        $_POST['page_blogs'] = stripslashes(trim($_POST['page_blogs']));
        $_POST['page_friends'] = stripslashes(trim($_POST['page_friends']));
        $_POST['page_events'] = stripslashes(trim($_POST['page_events']));
        $_POST['page_groups'] = stripslashes(trim($_POST['page_groups']));
    }
    if(!empty($_POST['domaine'])){
                if(!empty($_POST['name_site'])){
                    if(!empty($_POST['email_site'])){

                        $id_set = 1;
                        $domaine = $_POST['domaine'];
                        $name_site = $_POST['name_site'];
                        $email_site = $_POST['email_site'];
                        $template = $_POST['template'];
                        $default_lang = $_POST['default_lang'];
                        $sk_key = $_POST['sk_key'];
                        $page_members = $_POST['page_members'];
                        $page_photos = $_POST['page_photos'];
                        $page_videos = $_POST['page_videos'];
                        $page_music = $_POST['page_music'];
                        $page_blogs = $_POST['page_blogs'];
                        $page_friends = $_POST['page_friends'];
                        $page_events = $_POST['page_events'];
                        $page_groups = $_POST['page_groups'];

                        up_settings_site($id_set,$domaine,$name_site,$email_site,$template,$default_lang,$sk_key,$page_members,$page_photos,$page_videos,$page_music,$page_blogs,$page_friends,$page_events,$page_groups);

                        $success = $general->sokial('G27');
                        echo '<meta http-equiv="refresh" content="1;URL=settings.php">';
                    }else{
                        $error = $form->sokial('O05');
                    }
                }else{
                    $error = $form->sokial('O04');
                }
    }else{
        $error = $form->sokial('O03');
    }
}

include SK_VIEW.FILE;

include 'footer.php';

?>