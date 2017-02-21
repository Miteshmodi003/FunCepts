<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');

function videos_cat_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_cat FROM groups_cat");
    $number->execute();
    $total = $number->rowCount();

    return $total;
}

function videos_cat() {

    $db = SokialDB::getInstance();

    $cat = $db->query("SELECT id_cat,name
        FROM groups_cat
        ORDER BY id_cat DESC");
    
    $cat->setFetchMode(PDO::FETCH_OBJ);

    while($x = $cat->fetch()){

        $cats .= '
            <li><a href="groups_cat_view.php?id='.$x->id_cat.'" title="">'.$x->name.'</a></li>
        ';
    }

    $cat->closeCursor();
    return $cats;
    
}

?>
<article class="center animation fadeInUp">
    <section id="page_right">
        <h3 class="title"><i class="fa fa-clone"></i> Catégories Groupes (<?php echo videos_cat_number(); ?>)<span>Liste des catégories des groupes</span></h3>
        <div id="page_content">
            <ul id="lang_menu">
                <?php echo videos_cat(); ?>
            </ul>
        </div>
    </section>

    <section id="bloc_right">
        <div id="buttons_right">
            <a href="groups_cat_add.php" title="" class="btn_right btn_green"><i class="fa fa-plus"></i> Ajouter une catégorie</a>
        </div>
    </section>
</article>
<?php

include 'footer.php';

?>