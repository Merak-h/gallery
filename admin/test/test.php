<?php
session_start();
if (isset($_SESSION['login_user'])){
    //header('Location: home.php');
    echo "you are already log in.";
}

 // 暗号学的的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換します
 $toke_byte = openssl_random_pseudo_bytes(16);
 $csrf_token = bin2hex($toke_byte);
 // 生成したトークンをセッションに保存します
 $_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
</head>
<body>
    <h1 id="topTitle">chat app</h1>
        <div id="topContents">
            <a href="login.php">Log in other acount alredy I hove.</a>
        </div>
    

    <div id="infoArea">
        <h3>Create new acount.</h3>
        <form id="info">
            <div>
            <p>Enter your name.</p>
                <p id="nameHelp" style="color: red;"> </p>
                <input id="nameRou" type="text" name="name" placeholder="name">
            </div>
            <div>
            <p>Enter your birthday.</p>
            <p id="bDayHelp" style="color: red;"></p>
                <select id="bDayY" name="bDayY">
                    <option value="" selected>year</option>
                    <?php
                    for ($i=2021; $i>=1960; $i--){
                        
                        ?>
                        <option value="<?= $i ?>"><?= $i?>年</option>
                        <?php
                    }
                    ?>
                    </select>
                <select id="bDayM" name="bDayM">
                    <option value="" selected>month</option>
                    <?php
                    for ($i=1; $i<=12; $i++){
                        ?>
                        <option value="<?= $i ?>"><?= $i?>月</option>
                        <?php
                    }
                    ?>
                    </select>
                <select id="bDayD" name="bDayD">
                    <option value="" selected>day</option>
                    <?php
                    for ($i=1; $i<=31; $i++){
                        ?>
                        <option value="<?= $i ?>"><?= $i?>日</option>
                        <?php
                    }
                    ?>
                    </select>
            </div>
            <div><button type="submit" id="infoBtn">register</button></div>
        </form>
        </div>



    <div id="passSetArea">
        <h3>Create a password.</h3>
        <p>Enter a password which 6 or more alphanumeric and symbolic.</p>
                <form id="passSet" action="signup_action.php" method="POST">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$csrf_token?>">
                <input type="hidden" id="name" name="name">
                <input type="hidden" id="bDay" name="birthday">
                    <div>
                    <p id="passHelp" style="color: red;"></p>
                    <input type="password" id="pass" name="password" placeholder="password">
                    </div>
                    <div>
                    <p id="passConfHelp" style="color: red;"></p>
                    <input type="password" id="passConf" name="passwordCon" placeholder="confirm">
                    </div>
                    <button type="submit" id="passBtn">register</button>
                    <div id="back">back</div>
                </form>
        </div>


        

<script>//フォームの判定
        ////
    ////判定！！////
    ////

    //　各種タグの取得
    const nameRou = document.querySelector("#nameRou");
    const infoBtn = document.querySelector("#infoBtn");
    const nameHelp = document.querySelector("#nameHelp");
    const bDayHelp = document.querySelector("#bDayHelp");
    //ボタンを非活性化させる
    infoBtn.disabled = true;
    // 名前の正規表現
    const nameRegex = /^[A-Z0-9._-\s]{1,20}$/i;
    //状態の判別式
    const check = [false,false,false,false];
    // keyupイベントを拾う
    nameRou.addEventListener("keyup", () => {
    // nameRouの中身を正規表現でチェック
    if (nameRegex.test(nameRou.value)) {
        //checkリストの中身を変更
        check.splice(0,1,true)
        //checkリストにfalseがあるか
        if(!(check.includes(false))){
            // 成功した場合は、disabledをfalseに
            infoBtn.disabled = false; 
        }
    // 成功した場合は、disabledをfalseに
    //infoBtn.disabled = false;
    nameHelp.textContent = "";
    }  else {
            //checkリストの中身を変更
            check.splice(0,1,false);
    // 失敗した場合は、disabledをtrueに
    infoBtn.disabled = true;
    nameHelp.textContent = "Please enter a valid name in English.";
    }
    });

    //　各種タグの取得
    const bDayY = document.querySelector("#bDayY");
    const bDayM = document.querySelector("#bDayM");
    const bDayD = document.querySelector("#bDayD");

    // changeイベントを拾う
    bDayY.addEventListener('change', () => {const value = bDayY.value;handleChange(value,1)});
    bDayM.addEventListener('change', () => {const value = bDayM.value;handleChange(value,2)});
    bDayD.addEventListener('change', () => {const value = bDayD.value;handleChange(value,3)});

    function handleChange(value,type) {
        if (value!="") {
            //checkリストの中身を変更
            check.splice(type,1,true);
        if(check[1]==true && check[2]==true && check[3]==true){
            bDayHelp.textContent = "";
        }
            //checkリストにfalseがあるか
        if(!(check.includes(false))){
            // 成功した場合は、disabledをfalseに
            infoBtn.disabled = false; 
            
        }
            
        
        }else{
            //checkリストの中身を変更
            check.splice(type,1,false);
            // 失敗した場合は、disabledをtrueに
            infoBtn.disabled = true;
            bDayHelp.textContent = "Please enter it correctly.";
        }
    }

    ////
    ////判定！！END////
    ////
    </script>
<script>//情報仮登録処理
    const passSetArea = document.getElementById('passSetArea');
    const name = document.querySelector('#name');
    const bDay = document.querySelector('#bDay');
    passSetArea.style.display = 'none';

  
    const info = document.getElementById('info')
    info.addEventListener('submit', (e) => {
        // 下記処理で、デフォルトの処理(submit)がされなくなる
        e.preventDefault()
        e.stopPropagation()
        const bDayRou = bDayY.value+'.'+bDayM.value+'.'+bDayD.value

        name.value=nameRou.value;
        bDay.value=bDayRou;


        // 入力部分を非表示にする
        const infoArea = document.getElementById('infoArea')
        infoArea.style.display = 'none'

        // 入力部分を表示にする
        passSetArea.style.display = 'inline'



    })
    </script>
<script>//フォームの判定処理
    const pass = document.querySelector("#pass")
    const passConf = document.querySelector("#passConf")
    const passBtn = document.querySelector("#passBtn")
    const passHelp = document.querySelector("#passHelp")
    const passConfHelp = document.querySelector("#passConfHelp")





    //ボタンを非活性化させる
    passBtn.disabled = true;
    // 名前の正規表現
    const passRegex = /^(?=.*[A-Z])[a-zA-Z0-9.?/-]{6,24}$/;
    // keyupイベントを拾う
    pass.addEventListener("keyup",()=>{

        // inputの中身を正規表現でチェック
        passConf.value ="";
        if(passRegex.test(pass.value)){
            passHelp.textContent = "";
        }else{
            passBtn.disabled = true;
            passHelp.textContent = "6 or more alphanumeric characters and symbols, including at least one uppercase letter."
        }
    })
    passConf.addEventListener("keyup",()=>{
        if(pass.value===passConf.value && passRegex.test(pass.value)){

            passConfHelp.textContent = ""
                // 成功した場合は、disabledをfalseに
                passBtn.disabled = false; 
            }else{
                // 成功した場合は、disabledをfalseに
                passBtn.disabled = true;
                passConfHelp.textContent = "Passwords do not match."
            }
    })
    
    </script>
<script>
    const back = document.getElementById('back');
    back.addEventListener('click', (e) => {
        e.preventDefault()
        e.stopPropagation()
        pass.value ="";
        passConf.value ="";
        infoArea.style.display = 'inline';
        passSetArea.style.display = 'none';

    })
    </script>
<script>
        ////
        ////Ajaxによる登録処理！////
        ////
//        const passSet = document.getElementById('passSet');
//        passSet.addEventListener('submit', (e) => {
            // 下記処理で、デフォルトの処理(submit)がされなくなる
//            e.preventDefault()
//            e.stopPropagation()
//            passSetArea.style.display = 'none';

            //top情報入れ替え
//            document.getElementById("topTitle").innerHTML = 'Welcome to Caht app';
//            document.getElementById("topContents").innerHTML = '<a href="login.php">Let\'s start!</a>'; 



            //Ajax による送信処理
//                const csrfToken = document.getElementById('csrf_token');
//                const formData = 'password='+ encodeURIComponent(pass.value) + '&name=' + encodeURIComponent(name.value) + '&birthday=' + encodeURIComponent(bDay.value) + 'csrf_token=' + encodeURIComponent(csrfToken);
//                console.log(formData);
//                const xhr = new XMLHttpRequest()
//                xhr.addEventListener('load',(e) =>{
//                    console.log('aafg')
//                    const json = JSON.parse(xhr.response)
//                    const user_id = json['user_id']
//                    console.info(json)
//
//                    //top情報入れ替え
//                    document.getElementById("topTitle").innerHTML = 'Welcome to Caht app';
//                    document.getElementById("topContents").innerHTML = '<p>you\'er ID is "'+user_id+'"</p><a href="login.php">Let\'s start!</a>'; 
//                 
//                });
//                xhr.open(passSet.method, passSet.action);
//                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//                xhr.send(formData.replace(/%20/g,"+"));

//                return false;
//    })
    </script>
</body>
</html>