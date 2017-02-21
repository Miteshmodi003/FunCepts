<style type="text/css">body{background-image:url("<?php echo SK_IMG.$background; ?>");width:100%;height:100%;background-size:cover;background-repeat:no-repeat;background-position:0 0}</style>

<article id="index">
    <div id="infos_index">
        <h1><?php echo $index->sokial('I01').' '."FunCepts"; //echo $index->sokial('I01').' '.SK_NAMESITE; ?></h1>
        <p><?php echo $index->sokial('I02'); ?></p>
    </div>
    <div id="login_index">
        <section id="login">
            <?php
                if(!empty($errors)){foreach($errors as $e){echo '<div class="mess mess_error"><span>&times;</span><p>'.$e.'</p></div>'."\n";}}
                echo $connection;
            ?>
            <small><input type="checkbox" id="remember" checked="checked"/><label for="remember"><?php echo $form->sokial('F04'); ?></label> &middot; <a href="<?php echo $domaine.'forget'; ?>" title=""><?php echo $form->sokial('F05'); ?></a></small>
        </section>
        <a href="<?php echo $domaine.'registration'; ?>" title="" class="btn btn_green"><?php echo $form->sokial('F06'); ?></a>
    </div>
</article>