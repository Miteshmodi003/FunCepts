<script type="text/javascript">
$(document).ready(function(){
    var track_load = 0;
    var loading  = false;
    var total_groups = <?php echo $total_groups; ?>;
    $('#loadfeeds').load("<?php echo $domaine.$feed_load; ?>",{'page':track_load},function(){track_load++;$.getScript('<?php echo $domaine; ?>template/sokial/js/feed.js');});
    $(window).scroll(function(){
        if($(window).scrollTop()+$(window).height() == $(document).height()){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo $domaine.$feed_load; ?>',{'group_no': track_load}, function(data){
                    $("#loadfeeds").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false;
                }).fail(function(xhr,ajaxOptions,thrownError){
                    alert(thrownError);
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        }
    });
});
</script>
<article id="page">
    <section id="content">
        <div class="right">
            <div id="menu_feed">
                <ul>
                    <li><a href="<?php echo $domaine; ?>home" title=""<?php echo $fk1; ?>><i class="fa fa-list"></i><?php echo $header->sokial('H02'); ?></a></li>
                    <li><a href="<?php echo $domaine; ?>feed/friends" title=""<?php echo $fk2; ?>><i class="fa fa-users"></i><?php echo $header->sokial('H12'); ?></a></li>
                    <li><a href="<?php echo $domaine; ?>feed/photos" title=""<?php echo $fk3; ?>><i class="fa fa-picture-o"></i><?php echo $header->sokial('H04'); ?></a></li>
                    <li><a href="<?php echo $domaine; ?>feed/videos" title=""<?php echo $fk4; ?>><i class="fa fa-film"></i><?php echo $header->sokial('H05'); ?></a></li>
                    <li><a href="<?php echo $domaine; ?>feed/music" title=""<?php echo $fk5; ?>><i class="fa fa-music"></i><?php echo $header->sokial('H06'); ?></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="bloc ads">
                <h5><?php echo $general->sokial('G19'); ?></h5>
                <?php echo $ads; ?>
            </div>
        </div>
        <ul class="feed_tabs">
            <li><a href="#status" title=""><i class="fa fa-comment"></i></a></li>
            <li><a href="#videos" title=""><i class="fa fa-film"></i></a></li>
            <li><a href="#music" title=""><i class="fa fa-music"></i></a></li>
            <!--<li><a href="#place" title=""><i class="fa fa-map-marker"></i></a></li>-->
        </ul>
        <div class="feed_tabs_content">
            <div id="status" class="feed_tab">
                <form method="post" action="">
                    <textarea name="publish" id="publish" rows="1" placeholder="<?php echo $home->sokial('A01'); ?>"></textarea>
                    <button class="btn btn_blue post_status">Publish</button>
                </form>
            </div>
            <div id="videos" class="feed_tab">
                <form method="post" action="">
                    <div id="feed_video_add">
                        <input type="text" id="link_video" name="link_video" placeholder="<?php echo $video->sokial('V05'); ?>"/>
                        <button class="btn btn_blue post_video">Publish</button>
                    </div>
                </form>
            </div>
            <div id="music" class="feed_tab">
                <form method="post" action="">
                    <div id="feed_music_add">
                        <input type="text" id="link_music" name="link_music" placeholder="<?php echo $music->sokial('U07'); ?>"/>
                        <button class="btn btn_blue post_music">Publish</button>
                    </div>
                </form>
            </div>
            <!--<div id="place" class="feed_tab"></div>-->
        </div>
        <div id="refresh"></div><div id="update"></div>
        <div id="loadfeeds" class="left"></div>
        <div class="clear"></div>
        <div class="animation_image">
            <img src="<?php echo SK_IMG; ?>load.gif" alt=""/>
        </div>
    </section>
</article>