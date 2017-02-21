<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 15.12.14
// Version 3.0.4

/*
    Number videos
*/
function videos_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_video FROM videos");
    $number->execute();
    $total_video = $number->rowCount();

    return $total_video;
}

/*
    Video category
*/
function cat_video($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM videos_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Videos more
*/
function list_videos_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $vid = $db->query("SELECT id_video,cat_id,type,url,thumb,title,description,active,UNIX_TIMESTAMP() - date_add AS TimeVideo
        FROM videos
        ORDER BY id_video DESC
        LIMIT $position, $item_per_page");
    
    $vid->setFetchMode(PDO::FETCH_OBJ);

    while($x = $vid->fetch()){

        $time = duration($x->TimeVideo);
        $cat = cat_video($x->cat_id);

        $nbr = strlen($x->title);
        $titl = htmlspecialchars(substr($x->title,0,40));

        if($nbr>40){
            $title = $titl.'...';
        }else{
            $title = $x->title;
        }

        $nvr = strlen($x->description);
        $desc = htmlspecialchars(substr($x->description,0,60));

        if($nvr>60){
            $description = $desc.'...';
        }else{
            $description = $x->description;
        }

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($x->type) {
            case 'Youtube':
                $type = '<div class="round_os youtube"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-youtube"></i></span></div>';
                $search_type = 'category-youtube';
                break;
            case 'Vimeo':
                $type = '<div class="round_os vimeo"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-vimeo-square"></i></span></div>';
                $search_type = 'category-vimeo';
                break;
            case 'Twitch':
                $type = '<div class="round_os twitch"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-twitch"></i></span></div>';
                $search_type = 'category-twitch';
                break;
            case 'Vine':
                $type = '<div class="round_os vine"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-vine"></i></span></div>';
                $search_type = '';
                break;
            default:
                $type = '<div class="round_os vido"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-play-circle"></i></span></div>';
                $search_type = '';
                break;
        }

        $videos .= '
        <li class="mix '.$active.' '.$search_type.'" data-myorder="'.$x->id_video.'" style="display:inline-block">
            <a href="videos_view.php?id='.$x->id_video.'" title="">
                <div class="date_hour">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $vid->closeCursor();
    return $videos;
    
}

/*
    Videos search
*/
function list_videos_search($searchVideo) {

    $db = SokialDB::getInstance();

    $vid = $db->query("SELECT id_video,cat_id,type,url,thumb,title,description,active,UNIX_TIMESTAMP() - date_add AS TimeVideo
        FROM videos
        WHERE id_video LIKE '%$searchVideo%'
        OR type LIKE '%$searchVideo%'
        OR title LIKE '%$searchVideo%'
        ORDER BY id_video DESC");
    
    $vid->setFetchMode(PDO::FETCH_OBJ);

    while($x = $vid->fetch()){

        $time = duration($x->TimeVideo);
        $cat = cat_video($x->cat_id);

        $nbr = strlen($x->title);
        $titl = htmlspecialchars(substr($x->title,0,40));

        if($nbr>40){
            $title = $titl.'...';
        }else{
            $title = $x->title;
        }

        $nvr = strlen($x->description);
        $desc = htmlspecialchars(substr($x->description,0,60));

        if($nvr>60){
            $description = $desc.'...';
        }else{
            $description = $x->description;
        }

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($x->type) {
            case 'Youtube':
                $type = '<div class="round_os youtube"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-youtube"></i></span></div>';
                $search_type = 'category-youtube';
                break;
            case 'Vimeo':
                $type = '<div class="round_os vimeo"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-vimeo-square"></i></span></div>';
                $search_type = 'category-vimeo';
                break;
            case 'Twitch':
                $type = '<div class="round_os twitch"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-twitch"></i></span></div>';
                $search_type = 'category-twitch';
                break;
            case 'Vine':
                $type = '<div class="round_os vine"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-vine"></i></span></div>';
                $search_type = '';
                break;
            default:
                $type = '<div class="round_os vido"><span class="sk_bubble" sokial="'.$x->type.'"><i class="fa fa-play-circle"></i></span></div>';
                $search_type = '';
                break;
        }

        $videos .= '
        <li class="mix '.$active.' '.$search_type.'" data-myorder="'.$x->id_video.'" style="display:inline-block">
            <a href="videos_view.php?id='.$x->id_video.'" title="">
                <div class="date_hour">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $vid->closeCursor();
    return $videos;
    
}

/*
    Videos info
*/
function video_info($id_video) {

    $db = SokialDB::getInstance();

    $video = $db->prepare("SELECT id_video,user_id,ip_user,cat_id,type,url,thumb,unique_id,title,description,embed,privacy,active,views,likes,comments,shares,UNIX_TIMESTAMP() - date_add AS TimeVideo
        FROM videos
        WHERE id_video = ? ");

    $video->execute(array($id_video));
    
    if ($result = $video->fetch(PDO::FETCH_OBJ)) {
        $video->closeCursor();
        return $result;
    }
    return false;
}

?>