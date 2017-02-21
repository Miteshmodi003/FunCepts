<?php


/*
    Number music
*/
function music_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_music FROM music");
    $number->execute();
    $total_music = $number->rowCount();

    return $total_music;
}

/*
    Video category
*/
function cat_music($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM music_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Music more
*/
function list_music_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $sik = $db->query("SELECT id_music,cat_id,type,thumb,title,active,UNIX_TIMESTAMP() - date_add AS TimeMusic
        FROM music
        ORDER BY id_music DESC
        LIMIT $position, $item_per_page");
    
    $sik->setFetchMode(PDO::FETCH_OBJ);

    while($x = $sik->fetch()){

    	$cat = cat_music($x->cat_id);
    	$time = duration($x->TimeMusic);

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($x->type) {
            case 'SoundCloud':
                $type = '<i class="fa fa-soundcloud" style="color:#FF3900;font-size:24px"></i>';
                $search_type = 'category-soundcloud';
                break;
            case 'Mixcloud':
                $type = '<img src="template/default/img/mixcloud.png" alt="" style="width:30px;height:30px"/>';
                $search_type = 'category-mixcloud';
                break;
            default:
                $type = '';
                $search_type = '';
                break;
        }

        $nbr = strlen($x->title);
        $titl = htmlspecialchars(substr($x->title,0,40));

        if($nbr>40){
            $title = $titl.'...';
        }else{
            $title = $x->title;
        }


        $music .= '
        <li class="mix '.$active.' '.$search_type.'" data-myorder="'.$x->id_music.'" style="display:inline-block">
            <a href="music_view.php?id='.$x->id_music.'" title="">
                <div class="date_hour" style="font-size:18px">'.$cat->name.'<span></span></div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$time.'</span>
                    </div>
                </div>
                <div class="os_infos">
                	'.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $sik->closeCursor();
    return $music;
    
}

/*
    Music search
*/
function list_music_search($searchMusic) {

    $db = SokialDB::getInstance();

    $sik = $db->query("SELECT id_music,cat_id,type,thumb,title,active,UNIX_TIMESTAMP() - date_add AS TimeMusic
        FROM music
        WHERE id_music LIKE '%$searchMusic%'
        OR type LIKE '%$searchMusic%'
        OR title LIKE '%$searchMusic%'
        ORDER BY id_music DESC");
    
    $sik->setFetchMode(PDO::FETCH_OBJ);

    while($x = $sik->fetch()){

    	$cat = cat_music($x->cat_id);
    	$time = duration($x->TimeMusic);

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($x->type) {
            case 'SoundCloud':
                $type = '<i class="fa fa-soundcloud" style="color:#FF3900;font-size:24px"></i>';
                $search_type = 'category-soundcloud';
                break;
            case 'Mixcloud':
                $type = '<img src="template/default/img/mixcloud.png" alt="" style="width:30px;height:30px"/>';
                $search_type = 'category-mixcloud';
                break;
            default:
                $type = '';
                $search_type = '';
                break;
        }

        $nbr = strlen($x->title);
        $titl = htmlspecialchars(substr($x->title,0,40));

        if($nbr>40){
            $title = $titl.'...';
        }else{
            $title = $x->title;
        }


        $music .= '
        <li class="mix '.$active.' '.$search_type.'" data-myorder="'.$x->id_music.'" style="display:inline-block">
            <a href="music_view.php?id='.$x->id_music.'" title="">
                <div class="date_hour" style="font-size:18px">'.$cat->name.'<span></span></div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$time.'</span>
                    </div>
                </div>
                <div class="os_infos">
                	'.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $sik->closeCursor();
    return $music;
    
}

function music_info($id_music) {

    $db = SokialDB::getInstance();

    $music = $db->prepare("SELECT id_music,user_id,cat_id,type,url,thumb,title,embed,privacy,likes,comments,shares,views,UNIX_TIMESTAMP() - date_add AS TimeMusic
        FROM music
        WHERE id_music = ? ");

    $music->execute(array($id_music));
    
    if ($result = $music->fetch(PDO::FETCH_OBJ)) {
        $music->closeCursor();
        return $result;
    }
    return false;
}

?>
