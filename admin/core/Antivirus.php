<?php


$CONFIG['debug'] = 1;
$CONFIG['scanpath'] = $_SERVER['DOCUMENT_ROOT'];
$CONFIG['extensions'][] = 'htm';
$CONFIG['extensions'][] = 'html';
$CONFIG['extensions'][] = 'shtm';
$CONFIG['extensions'][] = 'shtml';
$CONFIG['extensions'][] = 'xml';
$CONFIG['extensions'][] = 'css';
$CONFIG['extensions'][] = 'js';
$CONFIG['extensions'][] = 'vbs';
$CONFIG['extensions'][] = 'php';
$CONFIG['extensions'][] = 'php3';
$CONFIG['extensions'][] = 'php4';
$CONFIG['extensions'][] = 'php5';
$CONFIG['extensions'][] = 'txt';
$CONFIG['extensions'][] = 'rtf';
$CONFIG['extensions'][] = 'doc';
$CONFIG['extensions'][] = 'conf';
$CONFIG['extensions'][] = 'dat';
$CONFIG['extensions'][] = 'conf';
$CONFIG['extensions'][] = 'config';
$CONFIG['extensions'][] = 'csv';
$CONFIG['extensions'][] = 'tab';
$CONFIG['extensions'][] = 'sql';
$CONFIG['extensions'][] = 'pl';
$CONFIG['extensions'][] = 'perl';
$CONFIG['extensions'][] = 'cgi';
$CONFIG['extensions'][] = 'exe';
$CONFIG['extensions'][] = 'jpg';
$CONFIG['extensions'][] = 'png';
$CONFIG['extensions'][] = 'gif';

$dircount = 0;
$filecount = 0;
$infected = 0;

if (!check_defs('virus.def')) trigger_error("Virus.def vulnerable to overwrite, please change permissions", E_USER_ERROR);

file_scan($CONFIG['scanpath'], $defs, $CONFIG['debug']);

$scan ='
<center>
<p><strong>'.$general->sokial('G76').' :</strong> ' . $dircount . '</p>
<p><strong>'.$general->sokial('G77').' :</strong> ' . $filecount . '</p>
<p style="color:#b13d48"><strong>'.$general->sokial('G78').' :</strong> ' . $infected . '</p>
</center>';

function file_scan($folder, $defs, $debug) {
	$general = new Languages('general');
	global $dircount, $report;
	$dircount++;
	if ($debug)
		$report .= '<li><b style="color:#999">'.$general->sokial('G79').'</b><span class="right">'.$folder.'</span></li>';
	if ($d = @dir($folder)) {
		while (false !== ($entry = $d->read())) {
			$isdir = @is_dir($folder.'/'.$entry);
			if (!$isdir and $entry!='.' and $entry!='..') {
				virus_check($folder.'/'.$entry,$defs,$debug);
			} elseif ($isdir  and $entry!='.' and $entry!='..') {
				file_scan($folder.'/'.$entry,$defs,$debug);
			}
		}
		$d->close();
	}
}

function virus_check($file, $defs, $debug) {

	global $filecount, $infected, $report, $CONFIG;

	$scannable = 0;
	foreach ($CONFIG['extensions'] as $ext) {
		if (substr($file,-3)==$ext)
			$scannable = 1;
	}

	if ($scannable) {
		$general = new Languages('general');
		$filecount++;
		$data = file($file);
		$data = implode('\r\n', $data);
		$clean = 1;
		foreach ($defs as $virus) {
			if (strpos($data, $virus[1])) {
				$report .= '<li style="background:#b13d48;color:#fff">'.$general->sokial('G80').'<span class="right">'.$file.'('.$virus[0].')</span></li>';
				$infected++;
				$clean = 0;
			}
		}
		if (($debug)&&($clean))
			$report .= '<li><b style="color:#18A55F">'.$general->sokial('G81').'</b><span class="right">'.$file.'</span></li>';
	}
}

function check_defs($file) {
	clearstatcache();
	$perms = substr(decoct(fileperms($file)),-2);
	if ($perms > 55)
		return false;
	else
		return true;
}

?>
