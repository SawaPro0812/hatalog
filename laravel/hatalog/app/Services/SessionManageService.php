<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\WorkSessions;

class SessionManageService
{
    //work_sessions登録処理（開始）
    public function createSessionStart($userId, $startTime) {

        //ユーザ登録する（ログインしていない場合は自動生成）
        $user = User::where('user_id', $userId)->first();
        if (empty($user)) {
            $newUser = new User();
            $newUser->user_id = $userId;
            $newUser->save();
        }
        
        //ワークセッションを登録する
        $workSession = new WorkSessions();
        $workSession->user_id = $userId;
        $workSession->start_time = $startTime;
        $workSession->save();

        //ワークセッションを再取得
        $workSession = WorkSessions::find($workSession->id);

        return $workSession;
    }

    //work_sessions登録処理（終了）
    public function createSessionEnd($userId, $endTime) {
        
        //ワークセッションを更新する
        $workSession = WorkSessions::where('user_id', '=', $userId)
            ->orderBy('start_time', 'desc')
            ->first(); 
        $workSession->end_time = $endTime;
        $workSession->save();

        //ワークセッションを再取得
        $workSession = WorkSessions::find($workSession->id);

        return $workSession;
    }
}