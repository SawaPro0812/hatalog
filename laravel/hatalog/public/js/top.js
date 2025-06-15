let startButtonFlag = true;
let endButtonFlag = false;
let startDate = new Date();
let toastTimeoutId = null;
let toastFadeOutId = null;

// 1秒ごとに合計時間更新
setInterval(calcTotalTime, 1000);

$(function(){

    //開始クリックイベント
    $('#work-start').on('click', function(e) {
        if (startButtonFlag) {
            startButtonFlag = false;
            workStart();
            setTimeout(function(){
                endButtonFlag = true;
            },60000);
        } else {
            showToast("勤務終了を押下してください。");
        }
    });
    //終了クリックイベント
    $('#work-end').on('click', function(e) {
        if (endButtonFlag) {
            startButtonFlag = true;
            endButtonFlag = false;
            workEnd();
        } else {
            showToast("勤務開始から1分経過していません。");
        }
        
    });
})

// 勤務開始
async function workStart() {
    let url = "/api/session/start";
    let type = "POST";

    // 返却用変数
    let result = {};

    // 現在時刻を取得
    startDate = new Date();
    var displayStartDate = ('0' + startDate.getHours()).slice(-2) + ':' + ('0' + startDate.getMinutes()).slice(-2) + ':' + ('0' + startDate.getSeconds()).slice(-2);
    var fmtStartDate = startDate.getFullYear() + '/' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '/' +('0' + startDate.getDate()).slice(-2) + ' ' + displayStartDate;

    // 1行追加（IDは使わず class で管理）
    $('#log-body').append(`
        <tr class="work-row">
            <td class="start">${displayStartDate}</td>
            <td>～</td>
            <td class="end"></td>
            <td class="work-time"></td>
        </tr>
    `);

    $('.table-area').scrollTop($('.table-area')[0].scrollHeight);

    let data = {
        "start_time" : fmtStartDate
    };

    await comm.ajax(url, type, data)
    .done((res)=>{
        console.log("Start Success!");
    })
    //通信が失敗したとき
    .fail((error)=>{
        //何か処理
        console.log("Start Error!");
    })

    return result;
}

// 勤務開始
async function workEnd() {
    let url = "/api/session/end";
    let type = "POST";

    // 返却用変数
    let result = {};

    // 現在時刻を取得
    let endDate = new Date();
    var displayEndDate = ('0' + endDate.getHours()).slice(-2) + ':' + ('0' + endDate.getMinutes()).slice(-2) + ':' + ('0' + endDate.getSeconds()).slice(-2);
    var fmtEndDate = endDate.getFullYear() + '/' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '/' +('0' + endDate.getDate()).slice(-2) + ' ' + displayEndDate;

    // 勤務時間を計算
    let workTime = endDate - startDate;
    let totalSeconds = Math.floor(workTime / 1000);
    let hours = Math.floor(totalSeconds / 3600);
    let minutes = Math.floor((totalSeconds % 3600) / 60);
    let seconds = totalSeconds % 60;
    let formatted = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

    // 最後の行の .end と .work-time を更新
    let lastRow = $('#log-body tr').last();
    lastRow.find('.end').text(displayEndDate);
    lastRow.find('.work-time').text(formatted);

    let data = {
        "end_time" : fmtEndDate
    };

    await comm.ajax(url, type, data)
    .done((res)=>{
        console.log("End Success!");
    })
    //通信が失敗したとき
    .fail((error)=>{
        //何か処理
        console.log("End Error!");
    })

    return result;
}

// 合計時間を計算して表示
function calcTotalTime() {
    let totalSeconds = 0;

    $('#log-body tr').each(function() {
        let workTime = $(this).find('.work-time').text();

        if (workTime) {
            const [h, m, s] = workTime.split(':').map(Number);
            totalSeconds += h * 3600 + m * 60 + s;
        }
    });

    // 最後の行が勤務中の場合（.end が空欄）
    let lastRow = $('#log-body tr').last();
    if (lastRow.length && lastRow.find('.end').text() === '') {
        let now = new Date();
        let currentSeconds = Math.floor((now - startDate) / 1000);
        totalSeconds += currentSeconds;
    }

    // 表示用に整形
    let h = Math.floor(totalSeconds / 3600);
    let m = Math.floor((totalSeconds % 3600) / 60);
    let s = totalSeconds % 60;
    let formatted = ('0' + h).slice(-2) + ':' + ('0' + m).slice(-2) + ':' + ('0' + s).slice(-2);

    $('#total-time-value').text(formatted);
}

//トースト通知
function showToast(message) {
    const toast = $('#toast');

    // 既存のフェードアウト待機タイマーがあればキャンセル
    if (toastTimeoutId !== null) {
        clearTimeout(toastTimeoutId);
        toastTimeoutId = null;
    }
    if (toastFadeOutId !== null) {
        clearTimeout(toastFadeOutId);
        toastFadeOutId = null;
    }

    // 再表示のためスタイルをリセット
    toast.stop(true, true); // アニメーション停止（jQuery）
    toast.text(message).css({
        'visibility': 'visible',
        'opacity': 1,
        'bottom': '50px'
    }).addClass('show');

    // 3秒後にフェードアウト処理
    toastTimeoutId = setTimeout(() => {
        toast.css({
            'opacity': 0,
            'bottom': '30px'
        });

        // 完全に透明になった後にクラスとスタイルをリセット
        toastFadeOutId = setTimeout(() => {
            toast.removeClass('show').css({
                'opacity': '',
                'visibility': '',
                'bottom': ''
            });

            // タイマーIDもリセット
            toastTimeoutId = null;
            toastFadeOutId = null;
        }, 600); // フェードアウト時間と合わせる
    }, 3000);
}