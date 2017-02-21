<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 28.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$cpuload = new CPULoad();
$cpuload->get_load();

function pingDomain($domain){
    $starttime = microtime(true);
    $file      = @fsockopen($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;
    if (!$file){
        $status = -1;
    }
    else{
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}

$ping = $_SERVER['HTTP_HOST'];

include SK_VIEW.FILE;

include 'footer.php';

?>