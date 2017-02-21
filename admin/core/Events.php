<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 17.12.14
// Version 3.0.4

/*
    Number events
*/
function events_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_event FROM events");
    $number->execute();
    $total_event = $number->rowCount();

    return $total_event;
}

/*
    Event category
*/
function cat_event($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM events_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Events more
*/
function list_events_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $evnt = $db->query("SELECT id_event,cat_id,title,address,city,country,day,date_end,details,active,UNIX_TIMESTAMP() - date_add AS TimeEvent
        FROM events
        ORDER BY id_event DESC
        LIMIT $position, $item_per_page");
    
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
    Events search
*/
function list_events_search($search) {

    $db = SokialDB::getInstance();

    $evnt = $db->query("SELECT id_event,cat_id,title,address,city,country,day,date_end,details,active,UNIX_TIMESTAMP() - date_add AS TimeEvent
        FROM events
        WHERE id_event LIKE '%$search%'
        OR title LIKE '%$search%'
        OR address LIKE '%$search%'
        OR city LIKE '%$search%'
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
    Events info
*/
function event_info($id_event) {

    $db = SokialDB::getInstance();

    $event = $db->prepare("SELECT id_event,cat_id,title,address,city,country,day,date_end,details,active,UNIX_TIMESTAMP() - date_add AS TimeEvent
        FROM events
        WHERE id_event = ? ");

    $event->execute(array($id_event));
    
    if ($result = $event->fetch(PDO::FETCH_OBJ)) {
        $event->closeCursor();
        return $result;
    }
    return false;
}

/*
    Number going
*/
function going_events_number($event_id) {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_going FROM events_going WHERE event_id = $event_id");
    $number->execute();
    $total_going = $number->rowCount();

    return $total_going;
}

?>