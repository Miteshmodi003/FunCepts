<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 31.12.14
// Version 3.0.4

// Template settings
function template_settings($id_setp) {

    $db = SokialDB::getInstance();

    $setting = $db->prepare("SELECT background_header,background_color,color_text,font_text,size_text,letter_spacing,line_height,color_link,color_link_hover,color_link_visited,color_link_active,button_blue,button_green,button_red
        FROM settings_template
        WHERE id_setp = ? ");

    $setting->execute(array($id_setp));
    
    if ($result = $setting->fetch(PDO::FETCH_OBJ)) {
        $setting->closeCursor();
        return $result;
    }
    return false;
}

/*
    Update settings
*/
function up_settings_template($id_setp,$background_header,$background_color,$color_text,$font_text,$size_text,$unity_text,$letter_spacing,$line_height,$text_align,$color_link,$color_link_hover,$color_link_visited,$color_link_active,$button_blue,$button_green,$button_red) {

    $db = SokialDB::getInstance();

    $update = $db->prepare("UPDATE settings_template SET
        background_header = '".$background_header."',
        background_color = '".$background_color."',
        color_text = '".$color_text."',
        font_text = '".$font_text."',
        size_text = '".$size_text."',
        unity_text = '".$unity_text."',
        letter_spacing = '".$letter_spacing."',
        line_height = '".$line_height."',
        text_align = '".$text_align."',
        color_link = '".$color_link."',
        color_link_hover = '".$color_link_hover."',
        color_link_visited = '".$color_link_visited."',
        color_link_active = '".$color_link_active."',
        button_blue = '".$button_blue."',
        button_green = '".$button_green."',
        button_red = '".$button_red."'
        WHERE
        id_setp = :id_setp");

    $update->bindValue(':id_setp', $id_setp);

    return $update->execute();
}

?>