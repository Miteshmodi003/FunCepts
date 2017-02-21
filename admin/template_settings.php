<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 31.12.15
// Version 3.0.6

include 'header.php';
include CORE.'Template.php';

access_admin();

$languages = languages_admin();
$temp = template_settings(1);

$template = new Languages('template');

if(isset($_POST) && isset($_POST['background_color'])){
    if(get_magic_quotes_gpc()){
        $_POST['background_header'] = stripslashes(trim($_POST['background_header']));
        $_POST['background_color'] = stripslashes(trim($_POST['background_color']));
        $_POST['color_text'] = stripslashes(trim($_POST['color_text']));
        $_POST['font_text'] = stripslashes(trim($_POST['font_text']));
        $_POST['size_text'] = stripslashes(trim($_POST['size_text']));
        $_POST['unity_text'] = stripslashes(trim($_POST['unity_text']));
        $_POST['letter_spacing'] = stripslashes(trim($_POST['letter_spacing']));
        $_POST['line_height'] = stripslashes(trim($_POST['line_height']));
        $_POST['text_align'] = stripslashes(trim($_POST['text_align']));
        $_POST['color_link'] = stripslashes(trim($_POST['color_link']));
        $_POST['color_link_hover'] = stripslashes(trim($_POST['color_link_hover']));
        $_POST['color_link_visited'] = stripslashes(trim($_POST['color_link_visited']));
        $_POST['color_link_active'] = stripslashes(trim($_POST['color_link_active']));
        $_POST['button_blue'] = stripslashes(trim($_POST['button_blue']));
        $_POST['button_green'] = stripslashes(trim($_POST['button_green']));
        $_POST['button_red'] = stripslashes(trim($_POST['button_red']));
    }
    if(!empty($_POST['background_color'])){

        $id_setp = 1;
        $background_header = $_POST['background_header'];
        $background_color = $_POST['background_color'];
        $color_text = $_POST['color_text'];
        $font_text = $_POST['font_text'];
        $size_text = $_POST['size_text'];
        $unity_text = $_POST['unity_text'];
        $letter_spacing = $_POST['letter_spacing'];
        $line_height = $_POST['line_height'];
        $text_align = $_POST['text_align'];
        $color_link = $_POST['color_link'];
        $color_link_hover = $_POST['color_link_hover'];
        $color_link_visited = $_POST['color_link_visited'];
        $color_link_active = $_POST['color_link_active'];
        $button_blue = $_POST['button_blue'];
        $button_green = $_POST['button_green'];
        $button_red = $_POST['button_red'];

        up_settings_template($id_setp,$background_header,$background_color,$color_text,$font_text,$size_text,$unity_text,$letter_spacing,$line_height,$text_align,$color_link,$color_link_hover,$color_link_visited,$color_link_active,$button_blue,$button_green,$button_red);

        $success = $general->sokial('G27');
        echo '<meta http-equiv="refresh" content="1;URL=template_settings.php">';

    }else{
        $error = $form->sokial('O03');
    }
}

include SK_VIEW.FILE;

include 'footer.php';

?>