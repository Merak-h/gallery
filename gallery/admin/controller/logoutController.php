<?php
session_start();
require_once('admin/function/logincheck.php');
class logoutController{

    function view(){
        login_check();
        include_once('admin/view/logoutView.php');
    }

    function process(){
        $_SESSION = array();
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }
        session_destroy();
        header('Location: main.php');


    }
}