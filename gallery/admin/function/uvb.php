<?php
    function h($s) {
        if(isset($s)){
            return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
        }else{
            return '';
        }
    }
    function csrf(){
        $toke_byte = openssl_random_pseudo_bytes(16);
        return(bin2hex($toke_byte));
    }

    function token_check($form_token,$session_token){
        if (!(isset($form_token) 
        && $form_token === $session_token)) {
        //失敗後続処理
          header("HTTP/1.1 400 Not Found");
          include ('400.php');
          exit;
        }
    }
    

 
?>