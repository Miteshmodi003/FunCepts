<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 17.12.14
// Version 3.0.4

/*
    Number groups
*/
function groups_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_group FROM groups");
    $number->execute();
    $total_group = $number->rowCount();

    return $total_group;
}

/*
    Group category
*/
function cat_group($id_cat) {

    $db = SokialDB::getInstance();

    $cat = $db->prepare("SELECT id_cat,name
        FROM groups_cat
        WHERE id_cat = ? ");

    $cat->execute(array($id_cat));
    
    if ($result = $cat->fetch(PDO::FETCH_OBJ)) {
        $cat->closeCursor();
        return $result;
    }
    return false;
}

/*
    Group photo
*/
function photo_group($group_id) {

    $db = SokialDB::getInstance();

    $photo = $db->prepare("SELECT id_photo_profil,group_id,file
        FROM groups_photo
        WHERE group_id = ? ");

    $photo->execute(array($group_id));
    
    if ($result = $photo->fetch(PDO::FETCH_OBJ)) {
        $photo->closeCursor();
        return $result;
    }
    return false;
}

/*
    Groups more
*/
function list_groups_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $grp = $db->query("SELECT id_group,cat_id,name,description,active,UNIX_TIMESTAMP() - date_add AS TimeGroup
        FROM groups
        ORDER BY id_group DESC
        LIMIT $position, $item_per_page");
    
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
    Groups search
*/
function list_groups_search($search) {

    $db = SokialDB::getInstance();

    $grp = $db->query("SELECT id_group,cat_id,name,description,active,UNIX_TIMESTAMP() - date_add AS TimeGroup
        FROM groups
        WHERE id_group LIKE '%$search%'
        OR name LIKE '%$search%'
        OR cat_id LIKE '%$search%'
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
    Groups info
*/
function group_info($id_group) {

    $db = SokialDB::getInstance();

    $group = $db->prepare("SELECT id_group,cat_id,name,description,active,UNIX_TIMESTAMP() - date_add AS TimeGroup
        FROM groups
        WHERE id_group = ? ");

    $group->execute(array($id_group));
    
    if ($result = $group->fetch(PDO::FETCH_OBJ)) {
        $group->closeCursor();
        return $result;
    }
    return false;
}

?>