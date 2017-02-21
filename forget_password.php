<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 20.11.15
// Version 3.0.5

include 'header.php';

$form = new Languages('form');

//include SK_VIEW.FILE;

?>
<article id="page_full">
	<section id="upload">
		<div id="content" class="form">
			<p><?php echo $general->sokial('G25'); ?></p>
			<form method="POST" action="" class="form">
                <input type="text" name="email_forget" value="" />
                <button type="submit"><?php echo $form->sokial('F13'); ?></button>
            </form>
		</div>
	</section>
</article>
<?php

include 'footer.php';

?>
