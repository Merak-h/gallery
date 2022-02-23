<?php 
session_start();
require_once('admin/function/logincheck.php');
require_once('admin/function/sessionUpdate.php');
    class infomationController{
        function view(){
            session_update();
            login_check();
            $user = $_SESSION['user'];
            $account = '@'.$user['user_id'];
            include_once('admin/view/infomationView.php');
        }
    }
?>