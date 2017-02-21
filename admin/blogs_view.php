<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 16.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_blog = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$video = new Languages('videos');
$blog = new Languages('blogs');
$view = blog_info($id_blog);
$cat = cat_blog($view->cat_id);

$time = duration($view->TimeBlog);

if($_POST['id_blog']){
    $db = SokialDB::getInstance();
    $id_blog = $_POST['id_blog'];
    $db->exec("DELETE FROM blogs WHERE id_blog = $id_blog");
    $success = $blog->sokial('B08');
    echo '<meta http-equiv="refresh" content="1;URL=blogs.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>