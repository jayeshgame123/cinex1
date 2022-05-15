<?php

ob_start();

require "backend/config.php";

//autoload
spl_autoload_register(function($class){
    require_once "classes/{$class}.php";
});


session_start();

require "functions.php";

$account=new Account;