
const userId = document.getElementById('id');
const idHelp = document.getElementById('help');
const button = document.getElementById('button');

//ボタンを非アクティブにする
button.disabled = true;


////IDが被っていないか確認(簡易)
userId.addEventListener('keyup', ()=>{
    //console.log(userId.value);
    const data = new FormData();
    data.set('id',userId.value);
    //console.log(data);
    
    //fetch によるajax通信
    fetch('admin/function/issetId.php', {
        method: 'POST',
        cache: 'no-cache',
        body: data
    })
    .then((res) => {
        if (!res.ok) {
            throw new Error(`${res.status} ${res.statusText}`);
        }
        return res.text(); // text にレスポンスデータが入る
    })
    .then((text) => {
        //console.log(text)
        //ここで処理
        if(text=='notIsset' && userId.value!==''){
            idHelp.innerHTML='<p style="color: green;">使用できます</p>';
            button.disabled = false;
            //console.log(lock);
            
        }else{
            if(userId.value==''){
                idHelp.innerHTML='<p style="color: red;">IDが未入力です。</p>';
            }else{
                idHelp.innerHTML='<p style="color: red;">このIDは既に使われています。</p>';
            }
            button.disabled = true;
            //console.log(lock);
        }
    })
    .catch((reason) => {
        // エラー出力
        console.log(reason);
    });
    
})