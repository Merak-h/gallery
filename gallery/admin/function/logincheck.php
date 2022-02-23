<?php
function login_check(){
    if(!isset($_SESSION['user'])){
        include_once('admin/view/loginNotView.php');
        
        exit;
    }
    return true;
}
function logout_check(){
    if(isset($_SESSION['user'])){
        include_once('admin/view/loginYetView.php');
        exit;
    }
    return true;
}