<?php


/*
    Number photos
*/
function photos_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_photo FROM photos");
    $number->execute();
    $total_photo = $number->rowCount();

    return $total_photo;
}

/*
    Photos more
*/
function list_photos_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $pic = $db->query("SELECT id_photo,user_id,file,size,length,width,style,views,likes,comments,shares,active,UNIX_TIMESTAMP() - date_add AS TimePhoto
        FROM photos
        ORDER BY id_photo DESC
        LIMIT $position, $item_per_page");
    
    $pic->setFetchMode(PDO::FETCH_OBJ);

    while($x = $pic->fetch()){

        $picture = new Languages('photos');
        $avatar = member_photo($x->user_id);
        $file = explode("300_", $x->file);
        $time = duration($x->TimePhoto);
        $ext = substr($file[1], 11);
        $size = number_format($x->size/1024, 2);

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($ext) {
            case 'png':
                $extension = 'category-png';
                break;
            case 'jpg':
                $extension = 'category-jpg';
                break;
            case 'gif':
                $extension = 'category-gif';
                break;
            default:
                $extension = '';
                break;
        }

        $photos .= '
        <li class="mix '.$active.' '.$extension.' category-'.$x->style.'" data-myorder="'.$x->id_photo.'" style="display:inline-block">
            <a href="photos_view.php?id='.$x->id_photo.'" title="">
                <div class="date_hour">'.$size.'<span>'.$picture->sokial('P09').'</span></div>
                <div class="infos_photos">
                    <img src="../'.$x->file.'" alt="" class="'.$x->style.'"/>
                    <div class="left">
                        <p>'.$file[1].'</p>
                        <span>'.$time.'</span>
                    </div>
                </div>
                <div class="os_infos" style="color:#999">
                    <i class="fa fa-thumbs-o-up"></i> '.$x->likes.'
                    <i class="fa fa-comments-o"></i> '.$x->comments.'
                    <i class="fa fa-share-square-o"></i> '.$x->shares.'
                </div>
            </a>
        </li>
        ';
    }

    $pic->closeCursor();
    return $photos;
    
}

/*
    Photos search
*/
function list_photos_search($searchPhoto) {

    $db = SokialDB::getInstance();

    $pic = $db->query("SELECT id_photo,user_id,file,size,length,width,style,views,likes,comments,shares,active,UNIX_TIMESTAMP() - date_add AS TimePhoto
        FROM photos
        WHERE id_photo LIKE '%$searchPhoto%'
        OR file LIKE '%$searchPhoto%'
        OR style LIKE '%$searchPhoto%'
        ORDER BY id_photo DESC");
    
    $pic->setFetchMode(PDO::FETCH_OBJ);

    while($x = $pic->fetch()){

        $picture = new Languages('photos');
        $avatar = member_photo($x->user_id);
        $file = explode("300_", $x->file);
        $time = duration($x->TimePhoto);
        $ext = substr($file[1], 11);
        $size = number_format($x->size/1024, 2);

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        switch($ext) {
            case 'png':
                $extension = 'category-png';
                break;
            case 'jpg':
                $extension = 'category-jpg';
                break;
            case 'gif':
                $extension = 'category-gif';
                break;
            default:
                $extension = '';
                break;
        }

        $photos .= '
        <li class="mix '.$active.' '.$extension.'  category-'.$x->style.'" data-myorder="'.$x->id_photo.'" style="display:inline-block">
            <a href="photos_view.php?id='.$x->id_photo.'" title="">
                <div class="date_hour">'.$size.'<span>'.$picture->sokial('P09').'</span></div>
                <div class="infos_photos">
                    <img src="../'.$x->file.'" alt="" class="'.$x->style.'"/>
                    <div class="left">
                        <p>'.$file[1].'</p>
                        <span>'.$time.'</span>
                    </div>
                </div>
                <div class="os_infos" style="color:#999">
                    <i class="fa fa-thumbs-o-up"></i> '.$x->likes.'
                    <i class="fa fa-comments-o"></i> '.$x->comments.'
                    <i class="fa fa-share-square-o"></i> '.$x->shares.'
                </div>
            </a>
        </li>
        ';
    }

    $pic->closeCursor();
    return $photos;
    
}

function photo_info($id_photo) {

    $db = SokialDB::getInstance();

    $photo = $db->prepare("SELECT id_photo,user_id,file,original,size,length,width,style,views,likes,comments,shares,active,UNIX_TIMESTAMP() - date_add AS TimePhoto
        FROM photos
        WHERE id_photo = ? ");

    $photo->execute(array($id_photo));
    
    if ($result = $photo->fetch(PDO::FETCH_OBJ)) {
        $photo->closeCursor();
        return $result;
    }
    return false;
}

?>
