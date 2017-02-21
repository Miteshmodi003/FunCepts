<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 20.11.15
// Version 3.0.5

$languages = languages();

if(connected_member()) {
    $nf_friends = number_friends($_SESSION['sk_id']);
    $members = new Languages('members');

    switch ($nf_friends->nf_friend) {
        case 0:
            $friends_chat = '<div style="text-align:center;padding:10px;color:#ccc">'.$members->sokial('M22').'</div>';
            break;
        default:
            $friends_chat = list_friends_chat($_SESSION['sk_id']);
            break;
    }
}

$_SESSION['username'] = $user->firstname;

?>
<?php if(connected_member()) { ?>
<script type="text/javascript">
//Tabs post
$(document).ready(function(){
    $(".tab_chat").hide();
    $("ul.tabs_chat li:first").addClass("active").show();
    $(".tab_chat:first").show();
    $("ul.tabs_chat li").click(function(){
        $("ul.tabs_chat li").removeClass("active");
        $(this).addClass("slec");
        $(".tab_chat").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});
</script>

<section id="langages">
    <a href="#" title="" data-width="500" data-rel="languages" class="poplight bold" rel="popup_name"><i class="fa fa-globe"></i></a>
</section>
<section id="open_chat"><?php echo $header->sokial('H12'); ?> (<?php echo $nf_friends->nf_friend ?>)</section>
<section id="right_chat">
    <aside id="chat">
        <ul class="tabs_chat">
            <li><a href="#friends_chat" title="">Chat</a></li>
            <li><a href="#activity_chat" title="">Activity</a></li>
        </ul>
    </aside>
    <div id="friends_chat" class="tab_chat">
        <?php echo $friends_chat ?>
    </div>
    <div id="activity_chat" class="tab_chat">
        <div style="text-align:center;padding:10px;color:#ccc">No activity</div>
    </div>
    <div id="close_chat"><i class=" fa-sign-in"></i><span>Hide Sidebar</span></div>
</section>
<?php } ?>

<div id="languages" class="popup_block">
    <div class="popup_top">
        <h4>Select your language</h4>
    </div>
    <div>
        <ul class="languages">
            <?php echo $languages; ?>
        </ul>
    </div>
</div>

</body>
</html>