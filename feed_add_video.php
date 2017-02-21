<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';
require(CORE.'Feeds.php');

if(isset($_POST['link_video'])){

	$link = $_POST['link_video'];
	$user = member_info($_SESSION['sk_id']);

	if(strpos($link, 'youtube.com')){
		$type = 'Youtube';
	}elseif(strpos($link, 'vimeo.com')){
		$type = 'Vimeo';
	}elseif(strpos($link, 'dailymotion.com')){
		$type = 'Dailymotion';
	}elseif(strpos($link, 'twitch.tv')){
		$type = 'Twitch';
	}elseif(strpos($link, 'ted.com')){
		$type = 'TED';
	}elseif(strpos($link, 'hulu.com')){
		$type = 'hulu';
	}elseif(strpos($link, 'vine.co')){
		$type = 'Vine';
	}elseif(strpos($link, 'collegehumor.com')){
		$type = 'CollegeHumor';
	}elseif(strpos($link, 'nfb.ca')){
		$type = 'NFB';
	}elseif(strpos($link, 'dotsub.com')){
		$type = 'Dotsub';
	}elseif(strpos($link, 'screenr.com')){
		$type = 'Screenr';
	}elseif(strpos($link, 'funnyordie.com')){
		$type = 'Funnyordie';
	}elseif(strpos($link, 'videojug.com')){
		$type = 'Videojug';
	}elseif(strpos($link, 'sapo.pt')){
		$type = 'Sapo';
	}elseif(strpos($link, 'metacafe.com')){
		$type = 'Metacafe';
	}elseif(strpos($link, 'ora.tv')){
		$type = 'Ora';
	}

	if (strstr($url, 'youtu.be')) {
		$yout = explode("youtu.be/", $url);
	}else{
		$yout = explode("v=", $url);
	}
	
	$vime = explode("vimeo.com/", $link);
	$vid = explode("video/", $link);
	$vids = explode("videos/", $link);
	$twit = explode("c/", $link);
	$talk = explode("talks/", $link);
	$watch = explode("watch/", $link);
	$vin = explode("v/", $link);
	$film = explode("film/", $link);
	$dots = explode("view/", $link);
	$scre = explode("screenr.com/", $link);
	$sapo = explode("videos.sapo.pt/", $link);
	$ortv = explode("0_", $link);

	switch($type) {
		case 'Youtube':
			$unique_id = $yout[1];
			$xml = youtube($unique_id);
			$title = $xml->title;
			$description = $xml->content;
			$thumb = 'http://i.ytimg.com/vi/'.$unique_id.'/mqdefault.jpg';
			$embed = '<iframe id="ytplayer" width="750" height="421" src="//www.youtube.com/embed/'.$unique_id.'?showinfo=0&amp;color=white&amp;theme=light" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Vimeo':
			$unique_id = $vime[1];
			$xml = vimeo($unique_id);
			$title = $xml->title;
			$description = $xml->description;
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="//player.vimeo.com/video/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Dailymotion':
			$unique_id = $vid[1];
			$xml = dailymotion($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="//www.dailymotion.com/embed/video/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Twitch':
			$unique_id = $twit[1];
			$title = 'undefined';
			$description = 'undefined';
			$thumb = SK_IMG.'twitch.png';
			$embed = '<object width="750" height="421" data="http://www.twitch.tv/widgets/archive_embed_player.swf" id="clip_embed_player_flash" type="application/x-shockwave-flash"><param name="movie" value="http://www.twitch.tv/widgets/archive_embed_player.swf"/><param name="allowScriptAccess" value="always"/><param name="allowNetworking" value="all"/><param name="allowFullScreen" value="true"/><param name="flashvars" value="auto_play=false&amp;start_volume=50&amp;chapter_id='.$unique_id.'"/></object>';
			break;
		case 'TED':
			$unique_id = $talk[1];
			$xml = ted($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="https://embed-ssl.ted.com/talks/'.$unique_id.'.html" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'hulu':
			$unique_id = $watch[1];
			$xml = hulu($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = $xml->large_thumbnail_url;
			$embed = $xml->html;
			break;
		case 'Vine':
			$unique_id = $vin[1];
			$title = 'undefined';
			$description = 'undefined';
			$thumb = SK_IMG.'vine.png';
			$embed = '<iframe width="750" height="421" class="vine-embed" src="https://vine.co/v/'.$unique_id.'/embed/simple?related=0" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>';
			break;
		case 'CollegeHumor':
			$unique_id = $vid[1];
			$xml = CollegeHumor($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="http://www.collegehumor.com/e/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'NFB':
			$unique_id = $film[1];
			$xml = nfbca($unique_id);
			$title = $xml->title;
			$description = $xml->video_description;
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="http://www.nfb.ca/film/'.$unique_id.'/embed/player" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Dotsub':
			$unique_id = $dots[1];
			$xml = dotsub($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = SK_IMG.'dotsub.png';
			$embed = '<iframe width="750" height="421" src="http://dotsub.com/media/'.$unique_id.'/e/c?width=750&height=421" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Screenr':
			$unique_id = $scre[1];
			$xml = screenr($unique_id);
			$title = $xml->title;
			$description = $xml->description;
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="https://www.screenr.com/embed/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Funnyordie':
			$unique_id = $vids[1];
			$xml = funnyordie($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="http://www.funnyordie.com/embed/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Videojug':
			$unique_id = $film[1];
			$xml = videojug($unique_id);
			$title = $xml->title;
			$description = 'undefined';
			$thumb = SK_IMG.'videojug.png';
			$embed = '<iframe width="750" height="421" src="http://www.videojug.com/embed/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Sapo':
			$unique_id = $sapo[1];
			$xml = sapo($unique_id);
			$title = $xml->title;
			$description = $xml->synopse;
			$thumb = SK_IMG.'sapo.png';
			$embed = '<iframe width="750" height="421" src="http://rd3.videos.sapo.pt/playhtml?file=http://rd3.videos.sapo.pt/'.$unique_id.'/mov/1&quality=sd" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Metacafe':
			$unique_id = $watch[1];
			$title = 'undefined';
			$description = 'undefined';
			$thumb = SK_IMG.'metacafe.png';
			$embed = '<iframe width="750" height="421" src="http://www.metacafe.com/embed/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		case 'Ora':
			$unique_id = '0_'.$ortv[1];
			$xml = oratv($unique_id);
			$title = $xml->title;
			$description = $xml->description;
			$thumb = $xml->thumbnail_url;
			$embed = '<iframe width="750" height="421" src="https://www.ora.tv/embed/'.$unique_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			break;
		default:
			$unique_id = '';
			$xml = '';
			$thumb = '';
			break;
	}

	add_video($user->id_user, 6, $type, $link, $thumb, $unique_id, $title, $description, $embed, 1);
	$last = last_id_video();
	feed_add_video($user->id_user, $last->id_video);

	$last_id_feed = last_id_feed();
	$last_video = last_video($last_id_feed->id_feed,$user->id_user);

	echo $last_video;
}

?>