$(function(){

    // 送信ボタンクリックイベント
    $('#work-start').on('click', function(e) {
        workStart();
    });

})

// 勤務開始
async function workStart() {
    let url = "/api/session/start";
    let type = "POST";

    //dataなしログインしたら使うかも？
    let data = {};

    // 返却用変数
    let result = {};

    await comm.ajax(url, type, data)
    .done((res)=>{
        if (res.message != "") {
            result = {
                boolean : true,
                message : res.message
            }
        }
    })
    //通信が失敗したとき
    .fail((error)=>{
        //何か処理
        console.log("失敗");
    })

    return result;
}