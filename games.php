<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 07.09.15
// Version 3.0.5

include 'header.php';
include CORE.'Games.php';

access_member();

$blog = new Languages('blogs');

if(isset($_GET['page']) && is_numeric($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$games = list_games($page,12);
$nb_game = games_number();

$nbr_game = $nb_game->n_games;

$games = $nbr_game != 0 ? $games : $blog->sokial('B07');

$nb_pages = ceil($nbr_game / 12);
$paginations .= '<div class="pagination"><ul>' . pagination($page, $nb_pages) . '</ul></div>';

?>
<article id="page_full">
    <section id="content">
		<?php echo $games; ?>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>
<?php

include 'footer.php';

?>