<?php

/*
    Number blogs
*/
function blogs_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_blog FROM blogs");
    $number->execute();
    $total_blog = $number->rowCount();

    return $total_blog;
}

/*
    Blog category
*/
function cat_blog($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM blogs_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Blogs more
*/
function list_blogs_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $blg = $db->query("SELECT id_blog,cat_id,title,description,active,likes,comments,shares,UNIX_TIMESTAMP() - date_add AS TimeBlog
        FROM blogs
        ORDER BY id_blog DESC
        LIMIT $position, $item_per_page");
    
    $blg->setFetchMode(PDO::FETCH_OBJ);

    while($x = $blg->fetch()){

    	$cat = cat_blog($x->cat_id);
    	$time = duration($x->TimeBlog);

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

        switch($x->cat_id) {
            case '1':
                $cat_search = 'category-news';
                break;
           	case '2':
                $cat_search = 'category-music';
                break;
            case '3':
                $cat_search = 'category-life';
                break;
            default:
                $cat_search = '';
                break;
        }

        $blogs .= '
        <li class="mix '.$active.' '.$cat_search.'" data-myorder="'.$x->id_blog.'" style="display:inline-block">
            <a href="blogs_view.php?id='.$x->id_blog.'" title="">
                <div class="date_hour">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
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

    $blg->closeCursor();
    return $blogs;
    
}

/*
    Blogs search
*/
function list_blogs_search($search) {

    $db = SokialDB::getInstance();

    $blg = $db->query("SELECT id_blog,cat_id,title,description,active,likes,comments,shares,UNIX_TIMESTAMP() - date_add AS TimeBlog
        FROM blogs
        WHERE id_blog LIKE '%$search%'
        OR cat_id LIKE '%$search%'
        OR title LIKE '%$search%'
        ORDER BY id_blog DESC");
    
    $blg->setFetchMode(PDO::FETCH_OBJ);

    while($x = $blg->fetch()){

    	$cat = cat_blog($x->cat_id);
    	$time = duration($x->TimeBlog);

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

        switch($x->cat_id) {
            case '1':
                $cat_search = 'category-news';
                break;
           	case '2':
                $cat_search = 'category-music';
                break;
            case '3':
                $cat_search = 'category-life';
                break;
            default:
                $cat_search = '';
                break;
        }

        $blogs .= '
        <li class="mix '.$active.' '.$cat_search.'" data-myorder="'.$x->id_blog.'" style="display:inline-block">
            <a href="blogs_view.php?id='.$x->id_blog.'" title="">
                <div class="date_hour">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
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

    $blg->closeCursor();
    return $blogs;
    
}

/*
    Blogs info
*/
function blog_info($id_blog) {

    $db = SokialDB::getInstance();

    $blog = $db->prepare("SELECT id_blog,user_id,ip_user,cat_id,title,description,privacy,views,likes,comments,shares,UNIX_TIMESTAMP() - date_add AS TimeBlog
        FROM blogs
        WHERE id_blog = ? ");

    $blog->execute(array($id_blog));
    
    if ($result = $blog->fetch(PDO::FETCH_OBJ)) {
        $blog->closeCursor();
        return $result;
    }
    return false;
}

?>
