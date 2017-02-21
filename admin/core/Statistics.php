<?php


/*
    Percentage
*/
function percentage($number, $total) {
	return $number * 100 / $total;
}

/*
    Daily visitor
*/
function daily_visitor() {

    $db = SokialDB::getInstance();

    $daily_date = date("Y-m-d");

    $number = $db->query("SELECT id_stat FROM statistics WHERE date_visit LIKE '$daily_date%' GROUP BY ip_visitor");
    $number->execute();
    $daily_visitor = $number->rowCount();

    return $daily_visitor;
}

/*
    Daily registration
*/
function daily_registration() {

    $db = SokialDB::getInstance();

    $daily_date = date("Y-m-d");

    $number = $db->query("SELECT id_user FROM users WHERE date_registration LIKE '$daily_date%'");
    $number->execute();
    $daily_registration = $number->rowCount();

    return $daily_registration;
}

/*
    Daily connection
*/
function daily_connection() {

    $db = SokialDB::getInstance();

    $daily_date = date("Y-m-d");

    $number = $db->query("SELECT id_session FROM users_sessions WHERE date_connection LIKE '$daily_date%'");
    $number->execute();
    $daily_connection = $number->rowCount();

    return $daily_connection;
}

/*
    Yesterday visitor
*/
function yesterday_visitor() {

    $db = SokialDB::getInstance();

    $yesterday_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y')));

    $number = $db->query("SELECT id_stat FROM statistics WHERE date_visit LIKE '$yesterday_date%' GROUP BY ip_visitor");
    $number->execute();
    $yesterday_visitor = $number->rowCount();

    return $yesterday_visitor;
}

/*
    Yesterday registration
*/
function yesterday_registration() {

    $db = SokialDB::getInstance();

    $yesterday_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y')));

    $number = $db->query("SELECT id_user FROM users WHERE date_registration LIKE '$yesterday_date%'");
    $number->execute();
    $yesterday_registration = $number->rowCount();

    return $yesterday_registration;
}

/*
    Yesterday connection
*/
function yesterday_connection() {

    $db = SokialDB::getInstance();

    $yesterday_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y')));

    $number = $db->query("SELECT id_session FROM users_sessions WHERE date_connection LIKE '$yesterday_date%'");
    $number->execute();
    $yesterday_connection = $number->rowCount();

    return $yesterday_connection;
}

/*
    Before Yesterday visitor
*/
function before_yesterday_visitor($day) {

    $db = SokialDB::getInstance();

    $before_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$day, date('y')));

    $number = $db->query("SELECT id_stat FROM statistics WHERE date_visit LIKE '$before_date%' GROUP BY ip_visitor");
    $number->execute();
    $before_yesterday_visitor = $number->rowCount();

    return $before_yesterday_visitor;
}

/*
    Before Yesterday registration
*/
function before_yesterday_registration($day) {

    $db = SokialDB::getInstance();

    $before_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$day, date('y')));

    $number = $db->query("SELECT id_user FROM users WHERE date_registration LIKE '$before_date%'");
    $number->execute();
    $before_yesterday_registration = $number->rowCount();

    return $before_yesterday_registration;
}

/*
    Before Yesterday connection
*/
function before_yesterday_connection($day) {

    $db = SokialDB::getInstance();

    $before_date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$day, date('y')));

    $number = $db->query("SELECT id_session FROM users_sessions WHERE date_connection LIKE '$before_date%'");
    $number->execute();
    $before_yesterday_connection = $number->rowCount();

    return $before_yesterday_connection;
}

/*
    Number man
*/
function number_man() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_user FROM users WHERE sex = 1");
    $number->execute();
    $number_man = $number->rowCount();

    return $number_man;
}

/*
    Number woman
*/
function number_woman() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_user FROM users WHERE sex = 2");
    $number->execute();
    $number_woman = $number->rowCount();

    return $number_woman;
}

/*
    Number online
*/
function number_online() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_user FROM users WHERE online = 1");
    $number->execute();
    $number_online = $number->rowCount();

    return $number_online;
}

/*
    Number offline
*/
function number_offline() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_user FROM users WHERE online = 0");
    $number->execute();
    $number_offline = $number->rowCount();

    return $number_offline;
}

/*
    Number photos commented
*/
function number_photos_commented() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_photo FROM photos WHERE comments > 0");
    $number->execute();
    $nbr_photo_comt = $number->rowCount();

    return $nbr_photo_comt;
}

/*
    Number photos shared
*/
function number_photos_shared() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_photo FROM photos WHERE shares > 0");
    $number->execute();
    $nbr_photo_share = $number->rowCount();

    return $nbr_photo_share;
}

/*
    Number videos commented
*/
function number_videos_commented() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_video FROM videos WHERE comments > 0");
    $number->execute();
    $nbr_photo_comt = $number->rowCount();

    return $nbr_photo_comt;
}

/*
    Number videos shared
*/
function number_videos_shared() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_video FROM videos WHERE shares > 0");
    $number->execute();
    $nbr_video_share = $number->rowCount();

    return $nbr_video_share;
}

/*
    Number music commented
*/
function number_musics_commented() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_music FROM music WHERE comments > 0");
    $number->execute();
    $nbr_music_comt = $number->rowCount();

    return $nbr_music_comt;
}

/*
    Number music shared
*/
function number_musics_shared() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_music FROM music WHERE shares > 0");
    $number->execute();
    $nbr_music_share = $number->rowCount();

    return $nbr_music_share;
}


/*
    Number blogs commented
*/
function number_blogs_commented() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_blog FROM blogs WHERE comments > 0");
    $number->execute();
    $nbr_blog_comt = $number->rowCount();

    return $nbr_blog_comt;
}

/*
    Number blogs shared
*/
function number_blogs_shared() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_blog FROM blogs WHERE shares > 0");
    $number->execute();
    $nbr_blog_share = $number->rowCount();

    return $nbr_blog_share;
}

/*
    Statitics referer
*/
function stats_referer() {

    $db = SokialDB::getInstance();

    $ref = $db->query("SELECT id_stat,ip_visitor,referer,COUNT(referer) AS NumberReferer
        FROM statistics
        GROUP BY referer
        ORDER BY NumberReferer DESC
        LIMIT 0,50");
    
    $ref->setFetchMode(PDO::FETCH_OBJ);

    while($x = $ref->fetch()){

        $referer .= '
        <tr>
            <td>'.$x->referer.'</td>
            <td>'.$x->NumberReferer.'</td>
        </tr>';
    }

    $ref->closeCursor();
    return $referer;
    
}

/*
    Statitics os
*/
function stats_os() {

    $db = SokialDB::getInstance();

    $os = $db->query("SELECT id_stat,ip_visitor,os_platform,COUNT(os_platform) AS NumberOs
        FROM statistics
        GROUP BY os_platform
        ORDER BY NumberOs DESC
        LIMIT 0,50");
    
    $os->setFetchMode(PDO::FETCH_OBJ);

    while($x = $os->fetch()){

        $os_platform .= '
        <tr>
            <td>'.$x->os_platform.'</td>
            <td>'.$x->NumberOs.'</td>
        </tr>';
    }

    $os->closeCursor();
    return $os_platform;
    
}

/*
    Statitics browser
*/
function stats_browser() {

    $db = SokialDB::getInstance();

    $bro = $db->query("SELECT id_stat,ip_visitor,browser,COUNT(browser) AS NumberBrowser
        FROM statistics
        GROUP BY browser
        ORDER BY NumberBrowser DESC
        LIMIT 0,50");
    
    $bro->setFetchMode(PDO::FETCH_OBJ);

    while($x = $bro->fetch()){

        $browser .= '
        <tr>
            <td>'.$x->browser.'</td>
            <td>'.$x->NumberBrowser.'</td>
        </tr>';
    }

    $bro->closeCursor();
    return $browser;
    
}

/*
    Statitics screen
*/
function stats_screen() {

    $db = SokialDB::getInstance();

    $scr = $db->query("SELECT id_stat,ip_visitor,screen_resolution,COUNT(screen_resolution) AS NumberScreen
        FROM statistics
        GROUP BY screen_resolution
        ORDER BY NumberScreen DESC
        LIMIT 0,50");
    
    $scr->setFetchMode(PDO::FETCH_OBJ);

    while($x = $scr->fetch()){

        $screen .= '
        <tr>
            <td>'.$x->screen_resolution.'</td>
            <td>'.$x->NumberScreen.'</td>
        </tr>';
    }

    $scr->closeCursor();
    return $screen;
    
}

/*
    Statitics pages
*/
function stats_pages() {

    $db = SokialDB::getInstance();

    $pag = $db->query("SELECT id_stat,ip_visitor,current_page,COUNT(current_page) AS NumberPage
        FROM statistics
        GROUP BY current_page
        ORDER BY NumberPage DESC
        LIMIT 0,50");
    
    $pag->setFetchMode(PDO::FETCH_OBJ);

    while($x = $pag->fetch()){

        $pages .= '
        <tr>
            <td>'.$x->current_page.'</td>
            <td>'.$x->NumberPage.'</td>
        </tr>';
    }

    $pag->closeCursor();
    return $pages;
    
}

?>
