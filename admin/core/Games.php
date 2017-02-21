<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 17.12.14
// Version 3.0.4

/*
    Number games
*/
function games_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_game FROM games");
    $number->execute();
    $total_game = $number->rowCount();

    return $total_game;
}

/*
    Game category
*/
function cat_game($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM games_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Games more
*/
function list_games_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $gam = $db->query("SELECT id_game,cat_id,thumb,title,description
        FROM games
        ORDER BY id_game DESC
        LIMIT $position, $item_per_page");
    
    $gam->setFetchMode(PDO::FETCH_OBJ);

    while($x = $gam->fetch()){

        $cat = cat_game($x->cat_id);

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

        $games .= '
        <li class="mix" data-myorder="'.$x->id_game.'" style="display:inline-block">
            <a href="games_view.php?id='.$x->id_game.'" title="">
                <div class="date_hour" style="font-size:16px">'.$cat->name.'</div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
                    </div>
                </div>
            </a>
        </li>
        ';
    }

    $gam->closeCursor();
    return $games;
    
}

/*
    Games search
*/
function list_games_search($search) {

    $db = SokialDB::getInstance();

    $gam = $db->query("SELECT id_game,cat_id,thumb,title,description
        FROM games
        WHERE id_game LIKE '%$search%'
        OR cat_id LIKE '%$search%'
        OR title LIKE '%$search%'
        ORDER BY id_game DESC");
    
    $gam->setFetchMode(PDO::FETCH_OBJ);

    while($x = $gam->fetch()){

        $cat = cat_game($x->cat_id);

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

        $games .= '
        <li class="mix" data-myorder="'.$x->id_game.'" style="display:inline-block">
            <a href="games_view.php?id='.$x->id_game.'" title="">
                <div class="date_hour" style="font-size:16px">'.$cat->name.'</div>
                <div class="infos_photos">
                    <img src="'.$x->thumb.'" alt=""/>
                    <div class="left">
                        <p>'.$title.'</p>
                        <span>'.$description.'</span>
                    </div>
                </div>
            </a>
        </li>
        ';
    }

    $gam->closeCursor();
    return $games;
    
}

/*
    Games info
*/
function game_info($id_game) {

    $db = SokialDB::getInstance();

    $game = $db->prepare("SELECT id_game,cat_id,thumb,cover,title,description,content
        FROM games
        WHERE id_game = ? ");

    $game->execute(array($id_game));
    
    if ($result = $game->fetch(PDO::FETCH_OBJ)) {
        $game->closeCursor();
        return $result;
    }
    return false;
}

?>