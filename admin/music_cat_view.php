<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');
$video = new Languages('videos');

function up_cat($id_cat,$name) {

    $db = SokialDB::getInstance();

    $update = $db->prepare("UPDATE music_cat SET
        name = '".$name."'
        WHERE
        id_cat = :id_cat");

    $update->bindValue(':id_cat', $id_cat);

    return $update->execute();
}

function cat_info($id_cat) {

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

$infos = cat_info($_GET['id']);

if(isset($_POST) && isset($_POST['name'])){
    if(get_magic_quotes_gpc()){
        $_POST['name'] = stripslashes(trim($_POST['name']));
    }
    if(!empty($_POST['name'])){

        $name = $_POST['name'];

        up_cat($_GET['id'],$name);

        echo '<meta http-equiv="refresh" content="1;URL=music_cat.php">';
    
    }else{
        $error = 'Veuillez rentrer un nom';
    }
}

if(isset($_POST) && isset($_POST['delete'])){

    $db = SokialDB::getInstance();

    $db->exec("DELETE FROM music_cat WHERE id_cat = '".$_POST['delete']."' ");

    echo '<meta http-equiv="refresh" content="1;URL=music_cat.php">';

}

?>
<article class="center animation fadeInUp">
    <section id="page_right">
        <h3 class="title"><i class="fa fa-clone"></i> Modifier catégorie <?php echo $infos->name; ?></h3>
        <div id="page_content">
            <form method="POST" action="" class="form">
                <label>Nom de la catégorie</label> <input type="text" name="name" value="<?php echo $infos->name; ?>" />
                <button type="submit" class="btn btn_green">Modifier</button>
            </form>
        </div>
    </section>
    <section id="bloc_right">
        <div id="buttons_right">
            <form method="POST" action="">
                <input type="hidden" name="delete" value="<?php echo $infos->id_cat; ?>"/>
                <button type="submit" class="btn_right btn_red" style="border:0;cursor:pointer;"><i class="fa fa-close"></i> Supprimer</button>
            </form>
        </div>
    </section>
</article>
<?php

include 'footer.php';

?>