<?php

namespace App\Services;

use App\Models\WorkSessions;

class HistoryService
{
    //勤務ログ取得
    public function getSorkSessionHistory($userId) {
        //ワークセッションを取得する
        $workSession = WorkSessions::where('user_id', $userId);
dd($workSession->first()->start_time);
        return $userId;
    }
}