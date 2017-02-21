<?php


/*
    Member photo
*/
function member_photo($id_user) {

    $db = SokialDB::getInstance();

    $avatar = $db->prepare("SELECT id_photo_profil,user_id,file,active
        FROM users_photo
        WHERE user_id = ?
        AND active = 1
        ORDER BY id_photo_profil DESC
        LIMIT 1");

    $avatar->execute(array($id_user));
    
    if ($result = $avatar->fetch(PDO::FETCH_OBJ)) {
        $avatar->closeCursor();
        return $result;
    }
    return false;
}

/*
    Country
*/
function country($code) {

    $db = SokialDB::getInstance();

    $country = $db->prepare("SELECT name_country
        FROM country
        WHERE code = ?");

    $country->execute(array($code));
    
    if ($result = $country->fetch(PDO::FETCH_OBJ)) {
        $country->closeCursor();
        return $result;
    }
    return false;
}

/*
    Country select
*/
function list_countries_select() {

    $db = SokialDB::getInstance();

    $cnt = $db->query("SELECT id_country,code,name_country
        FROM country
        ORDER BY id_country ASC");
    
    $cnt->setFetchMode(PDO::FETCH_OBJ);

    while($x = $cnt->fetch()){
        $countries .= '<option value="'.$x->code.'">'.$x->name_country.'</option>';
    }

    $cnt->closeCursor();
    return $countries;
    
}

/*
    Number members
*/
function members_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_user FROM users");
    $number->execute();
    $total_user = $number->rowCount();

    return $total_user;
}

/*
    Members more
*/
function list_members_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT id_user,firstname,lastname,sex,DATE_FORMAT(date_registration,'%d/%m') AS date_day,DATE_FORMAT(date_registration,'%H:%i') AS date_hour,country,os_name,browser,online
        FROM users
        ORDER BY id_user DESC
        LIMIT $position, $item_per_page");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        $user = new Languages('members');
        $avatar = member_photo($x->id_user);
        $country = country($x->country);

        switch($avatar->file) {
            case '':
                $photo = 'files/users/150x_nophoto.gif';
                break;
            default:
                $photo = $avatar->file;
                break;
        }

        switch($x->online) {
            case '1':
                $online = 'category-online';
                break;
            default:
                $online = 'category-offline';
                break;
        }

        switch($x->sex) {
            case '1':
                $sex = $user->sokial('M10');
                $cat_sex = 'category-man';
                break;
            default:
                $sex = $user->sokial('M11');
                $cat_sex = 'category-woman';
                break;
        }

        switch($x->os_name) {
            case 'Windows 8':
            case 'Windows 7':
            case 'Windows Vista':
            case 'Windows Server 2003/XP x64':
            case 'Windows XP':
            case 'Windows 2000':
            case 'Windows ME':
            case 'Windows 98':
            case 'Windows 95':
            case 'Windows 3.11':
                $os = '<div class="round_os windows"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-windows"></i></span></div>';
                break;
            case 'Mac OS X':
            case 'Mac OS 9':
            case 'iPhone':
            case 'iPod':
            case 'iPad':
                $os = '<div class="round_os apple"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-apple"></i></span></div>';
                break;
            case 'Linux':
            case 'Ubuntu':
                $os = '<div class="round_os linux"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-linux"></i></span></div>';
                break;
            case 'Mobile':
            case 'BlackBerry':
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
            case 'Android':
                $os = '<div class="round_os android"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-android"></i></span></div>';
                break;
            default:
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        switch($x->browser) {
            case 'Internet Explorer':
                $browser = '<div class="round_os ie"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/ie.png" alt=""/></span></div>';
                break;
            case 'Safari':
                $browser = '<div class="round_os safari"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/safari.png" alt=""/></span></div>';
                break;
            case 'Firefox':
                $browser = '<div class="round_os firefox"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/firefox.png" alt=""/></span></div>';
                break;
            case 'Chrome':
                $browser = '<div class="round_os chrome"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/chrome.png" alt=""/></span></div>';
                break;
            default:
                $browser = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->browser.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        $users .= '
        <li class="mix '.$online.' '.$cat_sex.'" data-myorder="'.$x->id_user.'" style="display:inline-block">
            <a href="members_view.php?id='.$x->id_user.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <img src="../'.$photo.'" alt=""/>
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$sex.', '.$user->sokial('M18').' '.$country->name_country.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$os.'
                    '.$browser.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

/*
    Members search
*/
function list_members_search($searchMember) {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT id_user,firstname,lastname,sex,DATE_FORMAT(date_registration,'%d/%m') AS date_day,DATE_FORMAT(date_registration,'%H:%i') AS date_hour,country,os_name,browser,online
        FROM users
        WHERE id_user LIKE '%$searchMember%'
        OR firstname LIKE '%$searchMember%'
        OR lastname LIKE '%$searchMember%'
        OR email LIKE '%$searchMember%'
        ORDER BY id_user DESC");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        $user = new Languages('members');
        $avatar = member_photo($x->id_user);
        $country = country($x->country);

        switch($avatar->file) {
            case '':
                $photo = 'files/users/150x_nophoto.gif';
                break;
            default:
                $photo = $avatar->file;
                break;
        }

        switch($x->online) {
            case '1':
                $online = 'category-online';
                break;
            default:
                $online = 'category-offline';
                break;
        }

        switch($x->sex) {
            case '1':
                $sex = $user->sokial('M10');
                $cat_sex = 'category-man';
                break;
            default:
                $sex = $user->sokial('M11');
                $cat_sex = 'category-woman';
                break;
        }

        switch($x->os_name) {
            case 'Windows 8':
            case 'Windows 7':
            case 'Windows Vista':
            case 'Windows Server 2003/XP x64':
            case 'Windows XP':
            case 'Windows 2000':
            case 'Windows ME':
            case 'Windows 98':
            case 'Windows 95':
            case 'Windows 3.11':
                $os = '<div class="round_os windows"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-windows"></i></span></div>';
                break;
            case 'Mac OS X':
            case 'Mac OS 9':
            case 'iPhone':
            case 'iPod':
            case 'iPad':
                $os = '<div class="round_os apple"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-apple"></i></span></div>';
                break;
            case 'Linux':
            case 'Ubuntu':
                $os = '<div class="round_os linux"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-linux"></i></span></div>';
                break;
            case 'Mobile':
            case 'BlackBerry':
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
            case 'Android':
                $os = '<div class="round_os android"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-android"></i></span></div>';
                break;
            default:
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        switch($x->browser) {
            case 'Internet Explorer':
                $browser = '<div class="round_os ie"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/ie.png" alt=""/></span></div>';
                break;
            case 'Safari':
                $browser = '<div class="round_os safari"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/safari.png" alt=""/></span></div>';
                break;
            case 'Firefox':
                $browser = '<div class="round_os firefox"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/firefox.png" alt=""/></span></div>';
                break;
            case 'Chrome':
                $browser = '<div class="round_os chrome"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/chrome.png" alt=""/></span></div>';
                break;
            default:
                $browser = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->browser.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        $users .= '
        <li class="mix '.$online.' '.$cat_sex.'" data-myorder="'.$x->id_user.'" style="display:inline-block">
            <a href="members_view.php?id='.$x->id_user.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <img src="../'.$photo.'" alt=""/>
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$sex.', '.$user->sokial('M18').' '.$country->name_country.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$os.'
                    '.$browser.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

function member_info($id_user) {

    $db = SokialDB::getInstance();

    $user = $db->prepare("SELECT id_user,firstname,lastname,sex,email,password,date_registration,ip_registration,country,os_name,browser,views,online
        FROM users
        WHERE id_user = ? ");

    $user->execute(array($id_user));
    
    if ($result = $user->fetch(PDO::FETCH_OBJ)) {
        $user->closeCursor();
        return $result;
    }
    return false;
}

function last_session_member($id_user) {

    $db = SokialDB::getInstance();

    $session = $db->prepare("SELECT id_session,user_id,ip_session,os_session,browser_session,UNIX_TIMESTAMP() - date_session AS TimeSession
        FROM users_sessions
        WHERE user_id = ? ");

    $session->execute(array($id_user));
    
    if ($result = $session->fetch(PDO::FETCH_OBJ)) {
        $session->closeCursor();
        return $result;
    }
    return false;
}

/*
    Members home
*/
function members_home() {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT id_user,firstname,lastname,sex,DATE_FORMAT(date_registration,'%d/%m') AS date_day,DATE_FORMAT(date_registration,'%H:%i') AS date_hour,country,os_name,browser,online
        FROM users
        ORDER BY id_user DESC
        LIMIT 0,5");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        $user = new Languages('members');
        $avatar = member_photo($x->id_user);
        $country = country($x->country);

        switch($avatar->file) {
            case '':
                $photo = 'files/users/150x_nophoto.gif';
                break;
            default:
                $photo = $avatar->file;
                break;
        }

        switch($x->online) {
            case '1':
                $online = 'category-online';
                break;
            default:
                $online = 'category-offline';
                break;
        }

        switch($x->sex) {
            case '1':
                $sex = $user->sokial('M10');
                $cat_sex = 'category-man';
                break;
            default:
                $sex = $user->sokial('M11');
                $cat_sex = 'category-woman';
                break;
        }

        switch($x->os_name) {
            case 'Windows 8':
            case 'Windows 7':
            case 'Windows Vista':
            case 'Windows Server 2003/XP x64':
            case 'Windows XP':
            case 'Windows 2000':
            case 'Windows ME':
            case 'Windows 98':
            case 'Windows 95':
            case 'Windows 3.11':
                $os = '<div class="round_os windows"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-windows"></i></span></div>';
                break;
            case 'Mac OS X':
            case 'Mac OS 9':
            case 'iPhone':
            case 'iPod':
            case 'iPad':
                $os = '<div class="round_os apple"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-apple"></i></span></div>';
                break;
            case 'Linux':
            case 'Ubuntu':
                $os = '<div class="round_os linux"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-linux"></i></span></div>';
                break;
            case 'Mobile':
            case 'BlackBerry':
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
            case 'Android':
                $os = '<div class="round_os android"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-android"></i></span></div>';
                break;
            default:
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        switch($x->browser) {
            case 'Internet Explorer':
                $browser = '<div class="round_os ie"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/ie.png" alt=""/></span></div>';
                break;
            case 'Safari':
                $browser = '<div class="round_os safari"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/safari.png" alt=""/></span></div>';
                break;
            case 'Firefox':
                $browser = '<div class="round_os firefox"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/firefox.png" alt=""/></span></div>';
                break;
            case 'Chrome':
                $browser = '<div class="round_os chrome"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/chrome.png" alt=""/></span></div>';
                break;
            default:
                $browser = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->browser.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        $users .= '
        <li class="mix '.$online.' '.$cat_sex.'" data-myorder="'.$x->id_user.'" style="display:inline-block">
            <a href="members_view.php?id='.$x->id_user.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <img src="../'.$photo.'" alt=""/>
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$sex.', '.$user->sokial('M18').' '.$country->name_country.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$os.'
                    '.$browser.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

/*
    Number user messages
*/
function number_user_messages($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_reply FROM messages_reply WHERE sender = $id_user OR receiver = $id_user");
    $number->execute();
    $total_message = $number->rowCount();

    return $total_message;
}

/*
    Number user friends
*/
function number_user_friends($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_friend FROM friends WHERE user1 = $id_user OR user1 = $id_user AND validate = 1");
    $number->execute();
    $total_friends = $number->rowCount();

    return $total_friends;
}

/*
    Number user photos
*/
function number_user_photos($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_photo FROM photos WHERE user_id = $id_user");
    $number->execute();
    $total_photos = $number->rowCount();

    return $total_photos;
}

/*
    Number user videos
*/
function number_user_videos($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_video FROM videos WHERE user_id = $id_user");
    $number->execute();
    $total_videos = $number->rowCount();

    return $total_videos;
}

/*
    Number user music
*/
function number_user_music($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_music FROM music WHERE user_id = $id_user");
    $number->execute();
    $total_music = $number->rowCount();

    return $total_music;
}

/*
    Number user blogs
*/
function number_user_blogs($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_blog FROM blogs WHERE user_id = $id_user");
    $number->execute();
    $total_blogs = $number->rowCount();

    return $total_blogs;
}

/*
    Number user replies forum
*/
function number_user_replies($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_reply FROM forum_topics_reply WHERE user_id = $id_user");
    $number->execute();
    $total_replies = $number->rowCount();

    return $total_replies;
}

/*
    Number user events
*/
function number_user_events($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_event FROM events WHERE user_id = $id_user");
    $number->execute();
    $total_events = $number->rowCount();

    return $total_events;
}

/*
    Number user groups
*/
function number_user_groups($id_user) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_group FROM groups WHERE user_id = $id_user");
    $number->execute();
    $total_groups = $number->rowCount();

    return $total_groups;
}

/*
    Members messages
*/
function list_members_messages($user_id) {

    $db = SokialDB::getInstance();

    $mes = $db->query("SELECT id_reply,sender,receiver,message,UNIX_TIMESTAMP() - time AS TimeMessage
        FROM messages_reply
        WHERE sender = $user_id OR receiver = $user_id
        ORDER BY id_reply DESC");
    
    $mes->setFetchMode(PDO::FETCH_OBJ);

    while($x = $mes->fetch()){

        $time = duration($x->TimeMessage);

        $messages .= '<p><i>'.$time.'</i> &raquo; <b>'.$x->message.'</b></p>';
    }

    $mes->closeCursor();
    return $messages;
    
}

/*
    Members home
*/
function members_friends($id_user) {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT f.id_friend,f.user1,f.user2,f.validate,f.time,u.id_user,u.firstname,u.lastname,u.sex,DATE_FORMAT(u.date_registration,'%d/%m') AS date_day,DATE_FORMAT(u.date_registration,'%H:%i') AS date_hour,u.country,u.os_name,u.browser,u.online
        FROM users u, friends f
        WHERE f.user1 = $id_user AND f.validate = 1 AND u.id_user = f.user2
        OR f.user2 = $id_user AND f.validate = 1 AND u.id_user = f.user1
        ORDER BY id_user DESC");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        $user = new Languages('members');
        $avatar = member_photo($x->id_user);
        $country = country($x->country);

        switch($avatar->file) {
            case '':
                $photo = 'files/users/150x_nophoto.gif';
                break;
            default:
                $photo = $avatar->file;
                break;
        }

        switch($x->online) {
            case '1':
                $online = 'category-online';
                break;
            default:
                $online = 'category-offline';
                break;
        }

        switch($x->sex) {
            case '1':
                $sex = $user->sokial('M10');
                $cat_sex = 'category-man';
                break;
            default:
                $sex = $user->sokial('M11');
                $cat_sex = 'category-woman';
                break;
        }

        switch($x->os_name) {
            case 'Windows 8':
            case 'Windows 7':
            case 'Windows Vista':
            case 'Windows Server 2003/XP x64':
            case 'Windows XP':
            case 'Windows 2000':
            case 'Windows ME':
            case 'Windows 98':
            case 'Windows 95':
            case 'Windows 3.11':
                $os = '<div class="round_os windows"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-windows"></i></span></div>';
                break;
            case 'Mac OS X':
            case 'Mac OS 9':
            case 'iPhone':
            case 'iPod':
            case 'iPad':
                $os = '<div class="round_os apple"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-apple"></i></span></div>';
                break;
            case 'Linux':
            case 'Ubuntu':
                $os = '<div class="round_os linux"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-linux"></i></span></div>';
                break;
            case 'Mobile':
            case 'BlackBerry':
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
            case 'Android':
                $os = '<div class="round_os android"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-android"></i></span></div>';
                break;
            default:
                $os = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->os_name.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        switch($x->browser) {
            case 'Internet Explorer':
                $browser = '<div class="round_os ie"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/ie.png" alt=""/></span></div>';
                break;
            case 'Safari':
                $browser = '<div class="round_os safari"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/safari.png" alt=""/></span></div>';
                break;
            case 'Firefox':
                $browser = '<div class="round_os firefox"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/firefox.png" alt=""/></span></div>';
                break;
            case 'Chrome':
                $browser = '<div class="round_os chrome"><span class="sk_bubble" sokial="'.$x->browser.'"><img src="template/default/img/chrome.png" alt=""/></span></div>';
                break;
            default:
                $browser = '<div class="round_os unknown"><span class="sk_bubble" sokial="'.$x->browser.'"><i class="fa fa-globe"></i></span></div>';
                break;
        }

        $users .= '
        <li class="mix '.$online.' '.$cat_sex.'" data-myorder="'.$x->id_user.'" style="display:inline-block">
            <a href="members_view.php?id='.$x->id_user.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <img src="../'.$photo.'" alt=""/>
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$sex.', '.$user->sokial('M18').' '.$country->name_country.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$os.'
                    '.$browser.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

/*
    Members_photos
*/
function members_photos($id_user) {

    $db = SokialDB::getInstance();

    $pic = $db->query("SELECT id_photo,user_id,file,size,length,width,style,views,likes,comments,shares,active,UNIX_TIMESTAMP() - date_add AS TimePhoto
        FROM photos
        WHERE user_id = $id_user
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
    Members videos
*/
function members_videos($id_user) {

    $db = SokialDB::getInstance();

    $vid = $db->query("SELECT id_video,cat_id,type,url,thumb,title,description,active,UNIX_TIMESTAMP() - date_add AS TimeVideo
        FROM videos
        WHERE user_id = $id_user
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
    Members music
*/
function members_music($id_user) {

    $db = SokialDB::getInstance();

    $sik = $db->query("SELECT id_music,cat_id,type,thumb,title,active,UNIX_TIMESTAMP() - date_add AS TimeMusic
        FROM music
        WHERE user_id = $id_user
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

/*
    Members blogs
*/
function members_blogs($id_user) {

    $db = SokialDB::getInstance();

    $blg = $db->query("SELECT id_blog,user_id,cat_id,title,description,active,likes,comments,shares,UNIX_TIMESTAMP() - date_add AS TimeBlog
        FROM blogs
        WHERE user_id = $id_user
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
    Members replies forum
*/
function members_replies_forum($id_user) {

    $db = SokialDB::getInstance();

    $rep = $db->query("SELECT id_reply,cat_id,topic_id,user_id,message,active,UNIX_TIMESTAMP() - date_add AS TimeReply
        FROM forum_topics_reply
        WHERE user_id = $id_user
        ORDER BY id_reply DESC");
    
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
    Members events
*/
function members_events($id_user) {

    $db = SokialDB::getInstance();

    $evnt = $db->query("SELECT id_event,user_id,cat_id,title,address,city,country,day,date_end,details,active,UNIX_TIMESTAMP() - date_add AS TimeEvent
        FROM events
        WHERE user_id = $id_user
        ORDER BY id_event DESC");
    
    $evnt->setFetchMode(PDO::FETCH_OBJ);

    while($x = $evnt->fetch()){

        $time = duration($x->TimeEvent);
        $cat = cat_event($x->cat_id);
        $country = country($x->country);

        $nbr = strlen($x->title);
        $titl = htmlspecialchars(substr($x->title,0,40));

        if($nbr>40){
            $title = $titl.'...';
        }else{
            $title = $x->title;
        }

        $nvr = strlen($x->details);
        $desc = htmlspecialchars(substr($x->details,0,60));

        if($nvr>60){
            $details = $desc.'...';
        }else{
            $details = $x->details;
        }

        switch($x->active) {
            case '1':
                $active = 'category-active';
                break;
            default:
                $active = 'category-notactive';
                break;
        }

        $events .= '
        <script type="text/javascript">
        $(function() { 
            $("#map'.$x->id_event.'").goMap({
                mapTypeControl:false,
                maptype:"ROADMAP",
                address:"'.$x->city.', '.$country->name_country.'", 
                zoom:10
            });
        });
        </script>
        <div class="event mix '.$active.'" data-myorder="'.$x->id_event.'" style="display:inline-block">
            <a href="events_view.php?id='.$x->id_event.'" title="">
                <div class="date_hour">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <div id="map'.$x->id_event.'" style="width:180px;height:180px;margin-right:20px;float:left"></div>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$details.'</span>
                        <p>'.$x->address.', '.$x->city.', '.$country->name_country.'</p>
                    </div>
                </div>
                <div class="os_infos">
                    '.$type.'
                </div>
            </a>
        </div>
        ';
    }

    $evnt->closeCursor();
    return $events;
    
}

/*
    Members groups
*/
function members_groups($id_user) {

    $db = SokialDB::getInstance();

    $grp = $db->query("SELECT id_group,user_id,cat_id,name,description,active,UNIX_TIMESTAMP() - date_add AS TimeGroup
        FROM groups
        WHERE user_id = $id_user
        ORDER BY id_group DESC");
    
    $grp->setFetchMode(PDO::FETCH_OBJ);

    while($x = $grp->fetch()){

        $time = duration($x->TimeGroup);
        $cat = cat_group($x->cat_id);
        $photo = photo_group($x->id_group);

        switch($photo->file) {
            case '':
                $photo_profil = 'files/groups/profil/150x_nophoto.png';
                break;
            default:
                $photo_profil = $photo->file;
                break;
        }

        $nbr = strlen($x->name);
        $name = htmlspecialchars(substr($x->name,0,40));

        if($nbr>40){
            $name = $name.'...';
        }else{
            $name = $x->name;
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

        $groups .= '
        <li class="mix '.$active.' '.$search_type.'" data-myorder="'.$x->id_group.'" style="display:inline-block">
            <a href="groups_view.php?id='.$x->id_group.'" title="">
                <div class="date_hour" style="font-size:18px">'.$cat->name.'<span>'.$time.'</span></div>
                <div class="infos_photos">
                    <img src="../'.$photo_profil.'" alt=""/>
                    <div class="left">
                        <p>'.$name.'</p>
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

    $grp->closeCursor();
    return $groups;
    
}

/*
    Update member infos
*/
function up_member_infos($id_user,$firstname,$lastname,$sex,$email,$country) {

    $db = SokialDB::getInstance();

    $update = $db->prepare("UPDATE users SET
        firstname = '".$firstname."',
        lastname = '".$lastname."',
        sex = '".$sex."',
        email = '".$email."',
        country = '".$country."'
        WHERE
        id_user = :id_user");

    $update->bindValue(':id_user', $id_user);

    return $update->execute();
}

?>
