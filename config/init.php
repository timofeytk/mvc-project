<?php

define("DEBUG", 1);

$path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";

$path = preg_replace("#[^/]+$#", '', $path);

if(strpos($path, 'localhost') !== false){
    $path = str_replace('localhost/mvc/public/', 'mvc', $path);
}else{
    $path = str_replace('/public/', '', $path);
}

define("PATH", $path);

require_once dirname(__DIR__) . '/vendor/autoload.php';