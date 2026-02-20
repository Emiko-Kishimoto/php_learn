// TODO: 要素を取得
const btnPostCode =document.getElementById('btn-postcode');
const postcodeInput = document.getElementById('postcode');
const prefSelect = document.getElementById('pref');
const address1 = document.getElementById('address1');
const address2 =document.getElementById
('address2');
const prefOptions = document.querySelectorAll('#pref option[value]');

// TODO: 住所検索ボタンにイベント登録
btnPostCode.addEventListener('click', async ()=>{
    const postcode = postcodeInput.value;
    const data = await getAddress(postcode);
    // console.log(data);
    console.log(data.results[0].address1);
    
    prefOptions.forEach(option=>{
        if(parseInt(option.value) === parseInt(data.results[0].prefcode)){
            option.selected = true;
        }
    });
    address1.value = data.results[0].address2;
    address2.value = data.results[0].address3;

    // pref.value = data.results[0].prefcode;
});

// TODO: APIに郵便番号を送信し住所のJSONデータを取得する非同期関数
// エンドポイント(https://zipcloud.ibsnet.co.jp/api/search)
async function getAddress(postcode){
    // APIへリクエストを送信
    // const responce = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postcode}`);
        const responce = await fetch(`./postcode.php?zipcode=${postcode}`);
    console.log(responce);
    if(responce.ok){
        // 正常にレスポンスが返ってきた場合
        const json = await responce.json();
        console.log(json);
        if(json.results){
            // 住所が取得できた場合
            return json;
        }else{
            // 住所が取得できなかった場合
            return '住所の取得に失敗しました';
        }

    }
}

getAddress();
