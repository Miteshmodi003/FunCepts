<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 02.01.15
// Version 3.0.6

include 'header.php';
include CORE.'Antivirus.php';

access_admin();

//include SK_VIEW.FILE;

?>
<article class="center animation fadeInUp">
    <section id="page">
        <h3 class="title"><i class="fa fa-bug"></i> <?php echo $general->sokial('G73'); ?><span><?php echo $general->sokial('G74'); ?></span></h3>
        <div id="page_content">
            <?php echo $scan; ?>
            <ul id="lang_menu">
            	<?php echo $report; ?>
            <ul>
        </div> 
    </section>
</article>
<?php

include 'footer.php';

?>