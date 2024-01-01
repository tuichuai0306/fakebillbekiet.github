<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', 2628000);

    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(2628000);
    
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Melbahja\Seo\MetaTags;

DB::$user = 'webcon';
DB::$password = 'webcon';
DB::$dbName = 'webcon';
DB::$encoding = 'utf8'; 