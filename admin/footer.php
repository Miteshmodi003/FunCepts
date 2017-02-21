<?php

$current_lang = !empty($_SESSION['language_admin']) ? current_languages($_SESSION['language_admin']) : current_languages(SK_LANG);

$languages = languages();

?>
<script type="text/javascript">
$(document).ready(function() {
    $('#languages').popup({
        outline:false,
        vertical:'top'
    });
    $('#about').popup({
        outline:false,
        vertical:'top'
    });
});
</script>

<div class="clear"></div>
<footer class="center" id="footer">
	<a href="#" class="languages_open"><?php echo $general->sokial('G01'); ?> : <?php echo $current_lang->name_lang; ?></a> - <a href="#" class="about_open"><?php echo $general->sokial('G02'); ?></a>
</footer>
<div id="languages" class="popup">
	<h3><?php echo $general->sokial('G03'); ?></h3>
	<div class="popup_body">
		<ul class="languages">
			<?php echo $languages; ?>
		<ul>
	    <!--<a href="#" class="languages_close">Close</a>-->
	</div>
</div>
<div id="about" class="popup">
	<h3><?php echo $general->sokial('G02'); ?></h3>
	<div class="popup_body">
		<h4 style="text-align:center"><?php echo $general->sokial('G12').' '.$set->name_site; ?></h4>
		<p><b><?php echo $general->sokial('G04'); ?> :</b> <?php echo $set->version; ?></p>
		<p><b><?php echo $general->sokial('G05'); ?> :</b> <?php echo $set->email_site; ?></p>
		<p><b><?php echo $general->sokial('G06'); ?> :</b> <?php echo $set->template; ?></p>
		<p><b><?php echo $general->sokial('G07'); ?> :</b> <?php echo $set->lang_default; ?></p>
		<p><b><?php echo $general->sokial('G08'); ?> :</b> <?php echo $set->sk_key; ?></p>
		<p><b><?php echo $general->sokial('G09'); ?> :</b> <?php echo $set->created; ?></p>
		<p><b><?php echo $general->sokial('G10'); ?> :</b> <?php echo $set->SKL; ?></p>
		<p><b><?php echo $general->sokial('G11'); ?> :</b> <?php echo $set->SKD; ?></p>
	</div>
</div>
<?php if(connected_admin()) { ?>
<header id="header">
    <nav id="navigation">
        <div>
            <img src="../files/users/admin.gif" alt=""/>
            <span>admin sokial</span>
        </div>
        <ul>
            <li<?php echo $ska1; ?>><a href="home.php" title=""><i class="fa fa-home"></i> <?php echo $general->sokial('G49'); ?></a></li>
            <li<?php echo $ska2; ?>><a href="members.php" title=""><i class="fa fa-user"></i> <?php echo $general->sokial('G50'); ?></a></li>
            <li<?php echo $ska3; ?>><a href="#"><i class="fa fa-hdd-o"></i> <?php echo $general->sokial('G51'); ?><span>&rsaquo;</span></a>
                <ul>
                    <li><a href="photos.php" title=""><i class="fa fa-picture-o"></i> <?php echo $general->sokial('G13'); ?></a></li>
                    <li><a href="videos.php" title=""><i class="fa fa-film"></i> <?php echo $general->sokial('G14'); ?></a></li>
                    <li><a href="music.php" title=""><i class="fa fa-music"></i> <?php echo $general->sokial('G15'); ?></a></li>
                    <li><a href="blogs.php" title=""><i class="fa fa-pencil-square-o"></i> <?php echo $general->sokial('G16'); ?></a></li>
                    <li><a href="forum.php" title=""><i class="fa fa-bullhorn"></i> <?php echo $general->sokial('G17'); ?></a></li>
                    <li><a href="events.php" title=""><i class="fa fa-calendar"></i> <?php echo $general->sokial('G18'); ?></a></li>
                    <li><a href="groups.php" title=""><i class="fa fa-users"></i> <?php echo $general->sokial('G19'); ?></a></li>
                    <li><a href="games.php" title=""><i class="fa fa-gamepad"></i> <?php echo $general->sokial('G23'); ?></a></li>
                </ul>
            </li>
            <li<?php echo $ska4; ?>><a href="#" title=""><i class="fa fa-line-chart"></i> <?php echo $general->sokial('G64'); ?><span>&rsaquo;</span></a>
                <ul>
                    <li><a href="stats_geo.php" title=""><i class="fa fa-map-marker"></i> <?php echo $general->sokial('G65'); ?></a></li>
                    <li><a href="stats_referer.php" title=""><i class="fa fa-chain"></i> <?php echo $general->sokial('G82'); ?></a></li>
                    <li><a href="stats_os.php" title=""><i class="fa fa-linux"></i> <?php echo $general->sokial('G83'); ?></a></li>
                    <li><a href="stats_browser.php" title=""><i class="fa fa-globe"></i> <?php echo $general->sokial('G84'); ?></a></li>
                    <li><a href="stats_screen.php" title=""><i class="fa fa-desktop"></i> <?php echo $general->sokial('G85'); ?></a></li>
                    <li><a href="stats_pages.php" title=""><i class="fa fa-files-o"></i> <?php echo $general->sokial('G86'); ?></a></li>
                </ul>
            </li>
            <li<?php echo $ska5; ?>><a href="#" title=""><i class="fa fa-folder-o"></i> <?php echo $general->sokial('G53'); ?><span>&rsaquo;</span></a>
                <ul>
                    <li><a href="template_settings.php" title=""><i class="fa fa-paint-brush"></i> <?php echo $general->sokial('G54'); ?></a></li>
                    <li><a href="template_theme.php" title=""><i class="fa fa-send-o"></i> <?php echo $general->sokial('G55'); ?></a></li>
                    <li><a href="template_responsive.php?w=854&amp;h=480" title=""><i class="fa fa-desktop"></i> <?php echo $general->sokial('G58'); ?></a></li>
                </ul>
            </li>
            <li<?php echo $ska6; ?>><a href="#" title=""><i class="fa fa-cogs"></i> <?php echo $general->sokial('G28'); ?><span>&rsaquo;</span></a>
                <ul>
                    <li><a href="settings.php" title=""><i class="fa fa-cog"></i> <?php echo $general->sokial('G39'); ?></a></li>
                    <li><a href="administrators.php" title=""><i class="fa fa-user"></i> <?php echo $general->sokial('G40'); ?></a></li>
                    <li><a href="server.php" title=""><i class="fa fa-dashboard"></i> <?php echo $general->sokial('G41'); ?></a></li>
                </ul>
            </li>
            <li<?php echo $ska7; ?>><a href="languages.php" title=""><i class="fa fa-language"></i> <?php echo $general->sokial('G66'); ?></a></li>
            <li<?php echo $ska8; ?>><a href="#" title=""><i class="fa fa-shield"></i> <?php echo $general->sokial('G56'); ?><span>&rsaquo;</span></a>
                <ul>
                    <li><a href="encryption_password.php" title=""><i class="fa fa-key"></i> <?php echo $general->sokial('G57'); ?></a></li>
                    <li><a href="bruteforce.php" title=""><i class="fa fa-rocket"></i> BruteForce</a></li>
                    <li><a href="antivirus.php" title=""><i class="fa fa-bug"></i> <?php echo $general->sokial('G73'); ?></a></li>
                </ul>
            </li>
            <li class="logout"><a href="logout.php" title=""><i class="fa fa-sign-out"></i> <?php echo $general->sokial('G52'); ?></a></li>
        </ul>
    </nav>
</header>
<?php } ?>
</body>
</html>