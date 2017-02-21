<!DOCTYPE html>
<html lang="fr">
<head>
   <title><?php echo SK_NAMESITE; ?></title>
   <meta charset="UTF-8"/>
   <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
   <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css"/>
   <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>sokial.php" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>feed.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>members.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>photos.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>videos.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>music.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>blogs.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>profil.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>chat.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>events.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>forum.css" media="all"/>
   <link rel="stylesheet" type="text/css" href="<?php echo SK_CSS; ?>groups.css" media="all"/>
   <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>sokial.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>photos.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>videos.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>music.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>blogs.js"></script>
   <script type="text/javascript" src="<?php echo SK_JS; ?>chat.js"></script>
   <!--[if lt IE 9]>
      <script src="https://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
      <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
</head>
<body>

<header>
   <div>
      <?php if(connected_member()) { ?>
      <a href="<?php echo $domaine; ?>home" title=""><img src="<?php echo SK_IMG.$set->logo; ?>" alt="" id="logo"/></a>
      <form method="post" action="<?php echo $domaine; ?>search"><input type="text" name="search" value="<?php echo $header->sokial('H01'); ?>" onclick="if(this.value=='<?php echo $header->sokial('H01'); ?>')this.value='';"/></form>
      <div id="notifs">
         <a href="<?php echo $domaine.'messages'; ?>" title=""><i class="fa fa-comments-o"></i></a>
         <a href="<?php echo $domaine.'friends'; ?>" title=""><i class="fa fa-user"></i><?php echo $notif_friend; ?></a>
         <a href="<?php echo $domaine.'notifications'; ?>" title=""><i class="fa fa-refresh"></i></a>
         <a href="<?php echo $domaine.'user/account'; ?>" title=""><i class="fa fa-gear" style="margin-left:20px"></i></a>
      </div>
      <?php }else{ ?>
      <a href="<?php echo $domaine.'index.php'; ?>" title=""><img src="<?php echo SK_IMG.$set->logo; ?>" alt="" id="logo"/></a>
      <div id="notifs">
         <p><?php echo $header->sokial('H11'); ?> : <a href="#" title="" data-width="500" data-rel="languages" class="poplight bold" rel="popup_name"><?php echo $current_lang->name_lang; ?></a></p>
      </div>
      <?php } ?>
   </div>
</header>

<?php if(connected_member()) { ?>
<nav id="main_menu">
   <ul>
      <li>
         <a href="<?php echo $domaine.'profil/'.$user->id_user; ?>" title="">
            <img src="<?php echo $photo_profil; ?>" alt="" />
            <span class="semi_bold capital"><?php echo $user->firstname.' '.$user->lastname; ?></span>
         </a>
      </li>
      <li<?php echo $sk1; ?>>
         <a href="<?php echo $domaine.'home'; ?>" title=""><i class="fa fa-list"></i><span><?php echo $header->sokial('H02'); ?></span></a>
      </li>
      <li<?php echo $sk2; ?>>
         <a href="<?php echo $domaine.'members'; ?>" title=""><i class="fa fa-user"></i><span><?php echo $header->sokial('H03'); ?></span></a>
      </li>
      <li<?php echo $sk3; ?>>
         <a href="<?php echo $domaine.'photos'; ?>" title=""><i class="fa fa-picture-o"></i><span><?php echo $header->sokial('H04'); ?></span></a>
      </li>
      <li<?php echo $sk4; ?>>
         <a href="<?php echo $domaine.'videos'; ?>" title=""><i class="fa fa-film"></i><span><?php echo $header->sokial('H05'); ?></span></a>
      </li>
      <li<?php echo $sk5; ?>>
         <a href="<?php echo $domaine.'musics'; ?>" title=""><i class="fa fa-music"></i><span><?php echo $header->sokial('H06'); ?></span></a>
      </li>
      <li<?php echo $sk6; ?>>
         <a href="<?php echo $domaine.'blogs'; ?>" title=""><i class="fa fa-pencil-square-o"></i><span><?php echo $header->sokial('H07'); ?></span></a>
      </li>
      <li<?php echo $sk7; ?>>
         <a href="<?php echo $domaine.'forum'; ?>" title=""><i class="fa fa-bullhorn"></i><span><?php echo $header->sokial('H08'); ?></span></a>
      </li>
      <li<?php echo $sk8; ?>>
         <a href="<?php echo $domaine.'events'; ?>" title=""><i class="fa fa-calendar"></i><span><?php echo $header->sokial('H09'); ?></span></a>
      </li>
      <li<?php echo $sk9; ?>>
         <a href="<?php echo $domaine.'groups'; ?>" title=""><i class="fa fa-users"></i><span><?php echo $header->sokial('H13'); ?></span></a>
      </li>
      <li<?php echo $sk10; ?>>
         <a href="<?php echo $domaine.'games'; ?>" title=""><i class="fa fa-gamepad"></i><span><?php echo $header->sokial('H14'); ?></span></a>
      </li>
   </ul>
   <ul id="logout">
      <li>
         <a href="<?php echo $domaine.'logout'; ?>"><i class="fa fa-sign-out"></i><span><?php echo $header->sokial('H10'); ?></span></a>
      </li>
   </ul>
</nav>
<?php } ?>