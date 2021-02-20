// TODO: 全体的にリファクタリングが必要だけど、今はしない

// ページ読込完了後にボタンにclickイベントを登録する
window.addEventListener("load", function(){
    // バリデーション(jquery.validationEngine.js)セット
    $('#lp_form1, #lp_form2, #lp_form3').validationEngine('attach', {
        promptPosition:"topLeft",
        scroll: false});

    // フォーム1の送信ボタンが押された時の処理
    document.getElementById("send_mixdata1").addEventListener("click", function(){
        // フォーム1に対してのバリデーション判定
        if (!$('#lp_form1').validationEngine('validate') ){
            return;
        }

        // FoemDataオブジェクトに要素セレクタを渡して宣言する
        var formDatas = document.getElementById("lp_form1");
        var mixedDatas = new FormData(formDatas);

        // XHRの宣言
        var XHR = new XMLHttpRequest();

        // openメソッドにPOSTを指定して送信先のURLを指定します
        XHR.open("POST", "../api/lp_search_and_easy_estimate", true);

        // sendメソッドにデータを渡して送信を実行する
        XHR.send(mixedDatas);

        // サーバの応答をonreadystatechangeイベントで検出して正常終了したらデータを取得する
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                // POST送信した結果を表示する
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
                // 入力項目をリセット
                document.getElementById('lp_form1').reset();
            }
        };
        // モーダルを出現させる
        $('#modalArea').fadeIn();
    } ,false);

    // フォーム2の送信ボタンが押された時の処理(1と同様の処理)
    document.getElementById("send_mixdata2").addEventListener("click", function(){
        if (!$('#lp_form2').validationEngine('validate') ){
            return;
        }

        var formDatas = document.getElementById("lp_form2");
        var mixedDatas = new FormData(formDatas);
        var XHR = new XMLHttpRequest();

        XHR.open("POST", "../api/lp_search_and_easy_estimate", true);
        XHR.send(mixedDatas);
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
                document.getElementById('lp_form2').reset();
            }
        $('#modalArea').fadeIn();
        };
    } ,false);

    // フォーム3の送信ボタンが押された時の処理(1と同様の処理)
    document.getElementById("send_mixdata3").addEventListener("click", function(){
        if (!$('#lp_form3').validationEngine('validate') ){
            return;
        }

        var formDatas = document.getElementById("lp_form3");
        var mixedDatas = new FormData(formDatas);
        var XHR = new XMLHttpRequest();

        XHR.open("POST", "../api/lp_search_and_easy_estimate", true);
        XHR.send(mixedDatas);
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
                document.getElementById('lp_form3').reset();
            }
        $('#modalArea').fadeIn();
        };
    } ,false);
}, false);

// モーダルウィンドウを閉じる時の挙動
$(function() {
    $('#closeModal , #modalBg').click(function() {
        $('#modalArea').fadeOut();
    });
});