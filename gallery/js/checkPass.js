
const pass1 = document.getElementById('pass1');
const pass2 = document.getElementById('pass2');

const pass1Help = document.getElementById('pass1Help');
const pass2Help = document.getElementById('pass2Help');

const button = document.getElementById('button');
//ボタンを非アクティブにする
button.disabled = true;

//pass1整合性確認
const passReg = /^(?=.*[A-Z0-9])[a-zA-Z0-9.?/-]{6,24}$/;
pass1.addEventListener('keyup',()=>{
    console.log(pass1.value)
    
    //確認用(pass2)の初期化
    pass2.value = '';
    //正規表現に合致するか
    
    if(passReg.test(pass1.value)){
        pass1Help.textContent = "";
    }else{
        pass1Help.innerHTML='<p style="color: red;">数字もしくは大文字を１文字以上含んだ６文字以上の英数字と記号を入力してください。</p>';
    }
    
})


//pass1==pass2の確認
pass2.addEventListener('keyup',()=>{
    
    if(pass1.value===pass2.value){
        pass2Help.innerHTML= "";
        button.disabled = false;
    }else{
        pass2Help.innerHTML= '<p style="color: red;">パスワードが一致しません。</p>';
        button.disabled = true;
    }
})



