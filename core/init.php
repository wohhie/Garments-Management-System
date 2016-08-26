<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set("Asia/Dhaka");

session_start();
error_reporting(0);

$GLOBALS['config']  =   array(
    'mysql' =>  array(
        'host'  =>  '127.0.0.1',
        'username'  =>  'root',
        'password'  =>  '',
        'dbname'  =>  'garments',
    ),

    'remember' =>  array(
        'cookie_name'  =>  'hash',
        'cookie_expiry'  =>  '84600',
    ),

    'session' =>  array(
        'session_name'  =>  'user',
    ),

);



spl_autoload_register(function($class){

    require_once 'classes/'. $class .'.php';

});


require_once 'functions/sanitize.php';


DB::getInstance();
/**
 * USER DATA
 */

if(Users::logged_in()){
    $session_user_id = $_SESSION['user'];
    $role = $_SESSION['role'];
    $user_data = Users::user_data($session_user_id,$role, 'mr.id', 'username','firstname','lastname', 'email', 'password','department','phone', 'address', 'gender', 'hiredate','address');
    
}
