// ページ読込完了後にボタンにclickイベントを登録する
window.addEventListener("load", function(){
    document.getElementById("send_mixdata1").addEventListener("click", function(){
        // FoemDataオブジェクトに要素セレクタを渡して宣言する
        var formDatas = document.getElementById("lp_form1");
        var mixedDatas = new FormData(formDatas);

        // XHRの宣言
        var XHR = new XMLHttpRequest();

        // openメソッドにPOSTを指定して送信先のURLを指定します
        XHR.open("POST", "lp_relay.php", true);

        // sendメソッドにデータを渡して送信を実行する
        XHR.send(mixedDatas);

        // サーバの応答をonreadystatechangeイベントで検出して正常終了したらデータを取得する
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                // POST送信した結果を表示する
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
            }
        };
    } ,false);
    document.getElementById("send_mixdata2").addEventListener("click", function(){
        // FoemDataオブジェクトに要素セレクタを渡して宣言する
        var formDatas = document.getElementById("lp_form2");
        var mixedDatas = new FormData(formDatas);

        // XHRの宣言
        var XHR = new XMLHttpRequest();

        // openメソッドにPOSTを指定して送信先のURLを指定します
        XHR.open("POST", "lp_relay.php", true);

        // sendメソッドにデータを渡して送信を実行する
        XHR.send(mixedDatas);

        // サーバの応答をonreadystatechangeイベントで検出して正常終了したらデータを取得する
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                // POST送信した結果を表示する
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
            }
        };
    } ,false);
    document.getElementById("send_mixdata3").addEventListener("click", function(){
        // FoemDataオブジェクトに要素セレクタを渡して宣言する
        var formDatas = document.getElementById("lp_form3");
        var mixedDatas = new FormData(formDatas);

        // XHRの宣言
        var XHR = new XMLHttpRequest();

        // openメソッドにPOSTを指定して送信先のURLを指定します
        XHR.open("POST", "lp_relay.php", true);

        // sendメソッドにデータを渡して送信を実行する
        XHR.send(mixedDatas);

        // サーバの応答をonreadystatechangeイベントで検出して正常終了したらデータを取得する
        XHR.onreadystatechange = function(){
            if(XHR.readyState == 4 && XHR.status == 200){
                // POST送信した結果を表示する
                document.getElementById("mixdata_response").innerHTML = XHR.responseText;
            }
        };
    } ,false);
}, false);

// モーダルウィンドウを出現させる
$(function() {
    $('#send_mixdata1').click(function() {
        $('#modalArea').fadeIn();
    });
    $('#send_mixdata2').click(function() {
        $('#modalArea').fadeIn();
    });
    $('#send_mixdata3').click(function() {
        $('#modalArea').fadeIn();
    });
    $('#closeModal , #modalBg').click(function() {
        $('#modalArea').fadeOut();
    });
});