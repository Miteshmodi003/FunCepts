<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 17.12.14
// Version 3.0.4

/*
    Number forum reply
*/
function forum_reply_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_reply FROM forum_topics_reply");
    $number->execute();
    $total_reply = $number->rowCount();

    return $total_reply;
}

/*
    Forum category
*/
function cat_forum($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM forum_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Forum topic
*/
function topic_forum($id_topic) {

    $db = SokialDB::getInstance();

    $topic = $db->prepare("SELECT id_topic,title
        FROM forum_topics
        WHERE id_topic = ? ");

    $topic->execute(array($id_topic));
    
    if ($result = $topic->fetch(PDO::FETCH_OBJ)) {
        $topic->closeCursor();
        return $result;
    }
    return false;
}

/*
    Forum reply more
*/
function list_forum_reply_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $rep = $db->query("SELECT id_reply,cat_id,topic_id,message,active,UNIX_TIMESTAMP() - date_add AS TimeReply
        FROM forum_topics_reply
        ORDER BY id_reply DESC
        LIMIT $position, $item_per_page");
    
    $rep->setFetchMode(PDO::FETCH_OBJ);

    while($x = $rep->fetch()){

    	$forum = new Languages('forum');
        $time = duration($x->TimeReply);
        $cat = cat_forum($x->cat_id);
        $topic = topic_forum($x->topic_id);

        $nvr = strlen($x->message);
        $desc = htmlspecialchars(substr($x->message,0,60));

        if($nvr>60){
            $message = $desc.'...';
        }else{
            $message = $x->message;
        }

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        $replies .= '
        <li class="mix '.$active.'" data-myorder="'.$x->id_reply.'" style="display:inline-block">
            <a href="forum_view.php?id='.$x->id_reply.'" title="">
                <div class="date_hour" style="font-size:16px">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <div class="left">
                        <p>'.$message.'</p>
                        <span>'.$forum->sokial('F10').' <i>'.$topic->title.'</i></span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $rep->closeCursor();
    return $replies;
    
}

/*
    Forum reply search
*/
function list_forum_reply_search($search) {

    $db = SokialDB::getInstance();

    $rep = $db->query("SELECT id_reply,cat_id,topic_id,message,active,UNIX_TIMESTAMP() - date_add AS TimeReply
        FROM forum_topics_reply
        WHERE id_reply LIKE '%$search%'
        OR message LIKE '%$search%'
        ORDER BY id_reply DESC");
    
    $rep->setFetchMode(PDO::FETCH_OBJ);

    while($x = $rep->fetch()){

        $time = duration($x->TimeReply);
        $cat = cat_forum($x->cat_id);
        $topic = topic_forum($x->topic_id);

        $nvr = strlen($x->message);
        $desc = htmlspecialchars(substr($x->message,0,60));

        if($nvr>60){
            $message = $desc.'...';
        }else{
            $message = $x->message;
        }

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        $replies .= '
        <li class="mix '.$active.'" data-myorder="'.$x->id_reply.'" style="display:inline-block">
            <a href="forum_view.php?id='.$x->id_reply.'" title="">
                <div class="date_hour" style="font-size:16px">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <div class="left">
                        <p>'.$message.'</p>
                        <span>Dans le topic '.$topic->title.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$type.'
                </div>
            </a>
        </li>
        ';
    }

    $rep->closeCursor();
    return $replies;
    
}

/*
    Forum replies info
*/
function forum_reply_info($id_reply) {

    $db = SokialDB::getInstance();

    $reply = $db->prepare("SELECT id_reply,cat_id,topic_id,message,UNIX_TIMESTAMP() - date_add AS TimeReply
        FROM forum_topics_reply
        WHERE id_reply = ? ");

    $reply->execute(array($id_reply));
    
    if ($result = $reply->fetch(PDO::FETCH_OBJ)) {
        $reply->closeCursor();
        return $result;
    }
    return false;
}
?>