<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 15.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$member = new Languages('members');
$picture = new Languages('photos');

function add_cat($name) {

	$db = SokialDB::getInstance();

	$add = $db->prepare("INSERT INTO blogs_cat SET
		name = :name");

	$add->bindValue(':name', $name);

	if($add->execute()) {
		return $db->lastInsertId();
	}
	return $add->errorInfo();
}

if(isset($_POST) && isset($_POST['name'])){
    if(get_magic_quotes_gpc()){
        $_POST['name'] = stripslashes(trim($_POST['name']));
    }
    if(!empty($_POST['name'])){

        $name = $_POST['name'];

        add_cat($name);

        echo '<meta http-equiv="refresh" content="1;URL=blogs_cat.php">';
    
    }else{
        $error = 'Veuillez rentrer un nom';
    }
}

?>
<article class="center animation fadeInUp">
    <section id="page_right">
        <h3 class="title"><i class="fa fa-clone"></i> Ajouter une catégorie</h3>
        <div id="page_content">
        	<?php if(isset($error)) echo '<div class="alert alert_error">'.$error.'</div>' ?>
	        <form method="POST" action="" class="form">
	            <label>Nom de la catégorie</label> <input type="text" name="name" value="" />
	            <button type="submit" class="btn btn_green">Ajouter</button>
	        </form>
	    </div>
    </section>
    <section id="bloc_right">
        <div id="buttons_right">
            <a href="blogs_cat_add.php" title="" class="btn_right btn_green"><i class="fa fa-plus"></i> Ajouter une catégorie</a>
        </div>
    </section>
</article>
<?php

include 'footer.php';

?>