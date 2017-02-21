<?php


define('CORE', dirname(__FILE__).'/');
define('FILE', basename($_SERVER['PHP_SELF']));

include '../core/Configuration.php';
include '../core/Database.php';
include CORE.'Languages.php';
include CORE.'Members.php';
include CORE.'Photos.php';
include CORE.'Videos.php';
include CORE.'Music.php';
include CORE.'Blogs.php';
include CORE.'Forum.php';
include CORE.'Events.php';
include CORE.'Groups.php';
include CORE.'Games.php';
include CORE.'Administrators.php';

date_default_timezone_set('Europe/Paris');

$set = site_settings(1);
$domaine = 'http://'.$_SERVER['HTTP_HOST'].'/admin/';

define('SK_TEMPLATE',  'default');
define('SK_NAMESITE',  $set->name_site);
define('SK_MAILSITE',  $set->email_site);
define('SK_LANG',  	   $set->lang_default);
define('SK_KEY',       $set->sk_key);

define('SL',  			  '/');
define('SK_THEME',  	  'template/');
define('SK_CSS',    	  $domaine.SK_THEME.SK_TEMPLATE.'/css/');
define('SK_JS',     	  $domaine.SK_THEME.SK_TEMPLATE.'/js/');
define('SK_IMG',    	  $domaine.SK_THEME.SK_TEMPLATE.'/img/');
define('SK_VIEW',         SK_THEME.SK_TEMPLATE.SL);
define('SK_LANGUAGES',    'languages/');

if (function_exists('xcache_set')) {
    function W($vars=null, $ttl=3600) {
	    $trace = debug_backtrace();
	    $trace = $trace[1];
	    $key = __FILE__ . md5(
            $trace['function']
            .serialize($trace['args'])
            .serialize($vars)
	    );
	    if (!xcache_isset($key)) {
            xcache_set($key, null, $ttl);
            $r = call_user_func_array($trace['function'], $trace['args']);
            xcache_set($key, $r, $ttl);
            return $r;
	    }
	    return xcache_get($key);
    }
}
else {
	function W(){return null;}
}

function site_settings($id_set) {

	$db = SokialDB::getInstance();

	$config = $db->prepare("SELECT SKL,SKD,name_site,email_site,version,template,lang_default,sk_key,created,logo,background,back_active,page_members,page_photos,page_videos,page_music,page_blogs,page_friends,page_events,page_groups
		FROM settings
		WHERE id_set = ? ");

	$config->execute(array($id_set));
	
	if ($result = $config->fetch(PDO::FETCH_OBJ)) {
		$config->closeCursor();
		return $result;
	}
	return false;
}

function languages() {

	$db = SokialDB::getInstance();

	$lang = $db->query("SELECT name_lang,code_iso
		FROM languages
		ORDER BY id_lang ASC");
	
	$lang->setFetchMode(PDO::FETCH_OBJ);

	while ($x = $lang->fetch()){
		$languages .= '<li><a href="'.$_SERVER['SCRIPT_URI'].'?lang='.$x->code_iso.'" title="">'.$x->name_lang.' ('.$x->code_iso.')</a></li>';
	}

	$lang->closeCursor();
	return $languages;
	
}

function current_languages($code_iso) {

	$db = SokialDB::getInstance();

	$lang = $db->prepare("SELECT name_lang,code_iso
		FROM languages
		WHERE code_iso = ? ");
	
	$lang->execute(array($code_iso));
	
	if ($result = $lang->fetch(PDO::FETCH_OBJ)) {
		$lang->closeCursor();
		return $result;
	}
	return false;
	
}

/*
	Time
*/
function duration($duration) {

	$years = floor($duration / (60 * 60 * 24 * 30 * 12));
	$month = floor($duration / (60 * 60 * 24 * 30));
	$week = floor($duration / (60 * 60 * 24 * 7));
	$days = floor($duration / (60 * 60 * 24)); 
	$shift = $duration % (60 * 60 * 24);
	$hour = floor($shift / (60 * 60));
	$shift = $shift % (60 * 60);
	$minutes = floor($shift / 60);
	$seconde = $shift % 60;

	if($years > 0){
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$years.' ans';
				break;
			case 'en':
				$time = $years.' years ago';
				break;
			default:
				$time = $years.' years ago';
				break;
		}
	}
	elseif($years == 1)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$years.' an';
				break;
			case 'en':
				$time = $years.' year ago';
				break;
			default:
				$time = $years.' year ago';
				break;
		}
	elseif($month > 0)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$month.' mois';
				break;
			case 'en':
				$time = $month.' month ago';
				break;
			default:
				$time = $month.' month ago';
				break;
		}
	elseif($week == 1)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$week.' semaine';
				break;
			case 'en':
				$time = $week.' week ago';
				break;
			default:
				$time = $week.' week ago';
				break;
		}
	elseif($week > 0)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$week.' semaines';
				break;
			case 'en':
				$time = $week.' weeks ago';
				break;
			default:
				$time = $week.' weeks ago';
				break;
		}
	elseif($days == 1)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$days.' jour';
				break;
			case 'en':
				$time = $days.' day ago';
				break;
			default:
				$time = $days.' day ago';
				break;
		}
	elseif($days > 0)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$days.' jours';
				break;
			case 'en':
				$time = $days.' days ago';
				break;
			default:
				$time = $days.' days ago';
				break;
		}
	elseif($days == 0 && $hour == 0 && $minutes == 0)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$seconde.' secondes';
				break;
			case 'en':
				$time = $seconde.' secondes ago';
				break;
			default:
				$time = $seconde.' secondes ago';
				break;
		}
	elseif($hour == 1)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$hour.' heure';
				break;
			case 'en':
				$time = $hour.' hour ago';
				break;
			default:
				$time = $hour.' hour ago';
				break;
		}
	elseif($hour)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$hour.' heures';
				break;
			case 'en':
				$time = $hour.' hours ago';
				break;
			default:
				$time = $hour.' hours ago';
				break;
		}
	elseif($days == 0 && $hour == 0)
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a '.$minutes.' minutes';
				break;
			case 'en':
				$time = $minutes.' minutes ago';
				break;
			default:
				$time = $minutes.' minutes ago';
				break;
		}
	else
		switch($_SESSION['language_admin']) {
			case 'fr':
				$time = 'Il y a quelques secondes';
				break;
			case 'en':
				$time = 'There are a few seconds';
				break;
			default:
				$time = 'There are a few seconds';
				break;
		}

	return $time;
	
}

/*
    Languages select
*/
function languages_admin() {

    $db = SokialDB::getInstance();

    $lang = $db->query("SELECT name_lang,code_iso
        FROM languages
        ORDER BY id_lang ASC");
    
    $lang->setFetchMode(PDO::FETCH_OBJ);

    while ($x = $lang->fetch()){
        $languages .= '<option value="'.$x->code_iso.'">'.$x->name_lang.' ('.$x->code_iso.')';
    }

    $lang->closeCursor();
    return $languages;
    
}

/*
    Update settings
*/
function up_settings_site($id_set,$domaine,$name_site,$email_site,$template,$default_lang,$sk_key,$page_members,$page_photos,$page_videos,$page_music,$page_blogs,$page_friends,$page_events,$page_groups) {

    $db = SokialDB::getInstance();

    $update = $db->prepare("UPDATE settings SET
        SKD = '".$domaine."',
        name_site = '".$name_site."',
        email_site = '".$email_site."',
        template = '".$template."',
        lang_default = '".$default_lang."',
        sk_key = '".$sk_key."',
        page_members = '".$page_members."',
        page_photos = '".$page_photos."',
        page_videos = '".$page_videos."',
        page_music = '".$page_music."',
        page_blogs = '".$page_blogs."',
        page_friends = '".$page_friends."',
        page_events = '".$page_events."',
        page_groups = '".$page_groups."'
        WHERE
        id_set = :id_set");

    $update->bindValue(':id_set', $id_set);

    return $update->execute();
}

define("TEMP_PATH","/tmp/"); 

function memory_usage(){

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory = $mem[2]/$mem[1]*100;
    $memory_usage = round($memory, 3);

    return $memory_usage;
}

class CPULoad { 
     
    function check_load() { 
        $fd = fopen("/proc/stat","r"); 
        if ($fd) { 
            $statinfo = explode("\n",fgets($fd, 1024)); 
            fclose($fd); 
            foreach($statinfo as $line) { 
                $info = explode(" ",$line); 
                //echo "<pre>"; var_dump($info); echo "</pre>"; 
                if($info[0]=="cpu") { 
                    array_shift($info);  // pop off "cpu" 
                    if(!$info[0]) array_shift($info); // pop off blank space (if any) 
                    $this->user = $info[0]; 
                    $this->nice = $info[1]; 
                    $this->system = $info[2]; 
                    $this->idle = $info[3]; 
//                    $this->print_current(); 
                    return; 
                } 
            } 
        } 
    } 
     
    function store_load() { 
        $this->last_user = $this->user; 
        $this->last_nice = $this->nice; 
        $this->last_system = $this->system; 
        $this->last_idle = $this->idle; 
    } 
     
    function save_load() { 
        $this->store_load(); 
        $fp = @fopen(TEMP_PATH."cpuinfo.tmp","w"); 
        if ($fp) { 
            fwrite($fp,time()."\n"); 
            fwrite($fp,$this->last_user." ".$this->last_nice." ".$this->last_system." ".$this->last_idle."\n"); 
            fwrite($fp,$this->load["user"]." ".$this->load["nice"]." ".$this->load["system"]." ".$this->load["idle"]." ".$this->load["cpu"]."\n"); 
            fclose($fp); 
        } 
    } 
     
    function load_load() { 
        $fp = @fopen(TEMP_PATH."cpuinfo.tmp","r"); 
        if ($fp) { 
            $lines = explode("\n",fread($fp,1024)); 
             
            $this->lasttime = $lines[0]; 
            list($this->last_user,$this->last_nice,$this->last_system,$this->last_idle) = explode(" ",$lines[1]); 
            list($this->load["user"],$this->load["nice"],$this->load["system"],$this->load["idle"],$this->load["cpu"]) = explode(" ",$lines[2]); 
            fclose($fp); 
        } else { 
            $this->lasttime = time() - 60; 
            $this->last_user = $this->last_nice = $this->last_system = $this->last_idle = 0; 
            $this->user = $this->nice = $this->system = $this->idle = 0; 
        } 
    } 
     
    function calculate_load() { 
        //$this->print_current(); 
         
        $d_user = $this->user - $this->last_user; 
        $d_nice = $this->nice - $this->last_nice; 
        $d_system = $this->system - $this->last_system; 
        $d_idle = $this->idle - $this->last_idle; 
         
        //printf("Delta - User: %f  Nice: %f  System: %f  Idle: %f<br>",$d_user,$d_nice,$d_system,$d_idle); 

        $total=$d_user+$d_nice+$d_system+$d_idle; 
        if ($total<1) $total=1; 
        $scale = 100.0/$total; 
         
        $cpu_load = ($d_user+$d_nice+$d_system)*$scale; 
        $this->load["user"] = $d_user*$scale; 
        $this->load["nice"] = $d_nice*$scale; 
        $this->load["system"] = $d_system*$scale; 
        $this->load["idle"] = $d_idle*$scale; 
        $this->load["cpu"] = ($d_user+$d_nice+$d_system)*$scale; 
    } 
     
    function print_current() { 
        printf("Current load tickers - User: %f  Nice: %f  System: %f  Idle: %f<br>", 
            $this->user, 
            $this->nice, 
            $this->system, 
            $this->idle 
        ); 
    } 

    function print_load() { 
        printf("User: %.1f%%  Nice: %.1f%%  System: %.1f%%  Idle: %.1f%%  Load: %.1f%%<br>", 
            $this->load["user"], 
            $this->load["nice"], 
            $this->load["system"], 
            $this->load["idle"], 
            $this->load["cpu"] 
        ); 
    } 

    function sample_load($interval=1) { 
        $this->check_load(); 
        $this->store_load(); 
        sleep($interval); 
        $this->check_load(); 
        $this->calculate_load(); 
    } 
     
    function get_load($fastest_sample=4) { 
        $this->load_load(); 
        $this->cached = (time()-$this->lasttime); 
        if ($this->cached>=$fastest_sample) { 
            $this->check_load();  
            $this->calculate_load(); 
            $this->save_load(); 
        } 
    } 

}

/*
    Errors login
*/
function list_errors_login() {

    $db = SokialDB::getInstance();

    $error = $db->query("SELECT id_error_login,email,ip_login,os_platform,browser,referer,host_ip,SUBSTRING(country_code, 1, 2) AS SubCountry,DATE_FORMAT(date_error,'%d/%m/%Y %H:%i') AS date_login
        FROM error_login
        ORDER BY id_error_login DESC
        LIMIT 0,50");
    
    $error->setFetchMode(PDO::FETCH_OBJ);

    while($x = $error->fetch()){

    	switch($x->SubCountry) {
            case 'en':
                $SubCountry = 'us';
                break;
            case 'zh':
                $SubCountry = 'cn';
                break;
            case 'da':
                $SubCountry = 'dk';
                break;
            case 'el':
                $SubCountry = 'gr';
                break;
            case 'ko':
                $SubCountry = 'kr';
                break;
            case 'ja':
                $SubCountry = 'jp';
                break;
            case 'fa':
                $SubCountry = 'ir';
                break;
            case 'nb':
                $SubCountry = 'no';
                break;
            case 'he':
                $SubCountry = 'il';
                break;
            case 'cs':
                $SubCountry = 'cz';
                break;
            default:
                $SubCountry = $x->SubCountry;
                break;
        }

        $country = country($SubCountry);

        $errors .= '
        <tr>
        	<td>'.$x->email.'</td>
        	<td>'.$x->ip_login.'</td>
        	<td>'.$x->os_platform.'</td>
        	<td>'.$x->browser.'</td>
        	<td>'.$x->referer.'</td>
        	<td>'.$x->host_ip.'</td>
        	<td>'.$country->name_country.'</td>
        	<td>'.$x->date_login.'</td>
        </tr>';
    }

    $error->closeCursor();
    return $errors;
    
}

?>
