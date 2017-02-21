<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 08.09.15
// Version 3.0.5

include 'header.php';
include CORE.'Games.php';

access_member();

$view = game_info($_GET['id']);

?>
<article id="page_full">
    <section id="content">
		<?php echo $view->content; ?>
	</section>
</article>
<?php

include 'footer.php';

?>