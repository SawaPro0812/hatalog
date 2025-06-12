// 最初にCSRFトークンを全Ajaxリクエストに設定（この一度だけでOK）
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

var comm = {

    ajax: function(url, type, data) {
        return $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        
            url     :   url,
            type    :   type,
            data    :   data,     //配列
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",   //送信するデータの型、種類
            dataType: "json"   //レスポンスの型、種類
        })
        
        //通信が成功した時
    /*    .done((res)=>{
            //何か処理
            console.log("成功");
            resolve(res);
        })
        //通信が失敗したとき
        .fail((error)=>{
            //何か処理
            console.log("失敗");
            reject(error);
        }) */
    }

}