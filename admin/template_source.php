<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 27.12.15
// Version 3.0.6

include 'header.php';

access_admin();

//include SK_VIEW.FILE;

// 1 : on ouvre le fichier
$monfichier = fopen('index.php', 'r+');
 
// 2 : on lit la première ligne du fichier
$ligne = fgets($monfichier);
 
// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($monfichier);

?>
<script type="text/javascript" src="<?php echo SK_JS; ?>EditArea/edit_area_full.js"></script>
<script type="text/javascript">
editAreaLoader.init({
    id: "example_2" // id of the textarea to transform  
    ,start_highlight: true
    ,allow_toggle: false
    ,language: "en"
    ,syntax: "html" 
    ,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
    ,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
    ,is_multi_files: true
    ,EA_load_callback: "editAreaLoaded"
    ,show_line_colors: true
});
function editAreaLoaded(id){
    if(id=="example_2")
    {
        open_file1();
        open_file2();
    }
}

function open_file1(){
    var new_file= {id: "to\\ é # € to", text: "$authors= array();\n$news= array();", syntax: 'php', title: 'beautiful title'};
    editAreaLoader.openFile('example_2', new_file);
}

function open_file2(){
    var new_file= {id: "Filename", text: "<a href=\"toto\">\n\tbouh\n</a>\n<!-- it's a comment -->", syntax: 'html'};
    editAreaLoader.openFile('example_2', new_file);
}

function close_file1(){
    editAreaLoader.closeFile('example_2', "to\\ é # € to");
}
</script>

<article class="center animation fadeInUp">
    <section id="page">
        <h3 class="title">Code source<span>Vous pouvez éditer tous les fichiers du code source ci-dessous</span></h3>
        <div id="page_content">
            <?php echo htmlspecialchars($ligne); ?>
            <textarea id="example_2" style="height: 250px; width: 100%;" name="test_2">
        </textarea>
        </div>
    </section>
</article>
<?php

include 'footer.php';

?>