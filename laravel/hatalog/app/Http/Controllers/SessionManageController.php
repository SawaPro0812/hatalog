<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\SessionManageService;

class SessionManageController extends Controller
{
    protected $service;

    public function __construct(SessionManageService $service)
    {
        $this->service = $service;
    }

    // 勤務開始処理
    public function start(Request $request) {
        // temp_user_id をセッションに保存（なければ生成）
        if (!session()->has('temp_user_id')) {
            session(['temp_user_id' => Str::uuid()->toString()]);
        }

        $tempUserId = session('temp_user_id');

        $startTime = $request->input('start_time');

        $result = $this->service->createSessionStart($tempUserId, $startTime);
        $param = [
            'workSession' => $result,
            'tempUserId' => $tempUserId,
            'startTime' => $startTime
        ];
        
        return response()->json($param);
    }

    // 勤務終了処理
    public function end(Request $request) {
        // temp_user_id をセッションに保存（なければ生成）
        if (!session()->has('temp_user_id')) {
            session(['temp_user_id' => Str::uuid()->toString()]);
        }

        $tempUserId = session('temp_user_id');

        $endTime = $request->input('end_time');

        $result = $this->service->createSessionEnd($tempUserId, $endTime);
        $param = [
            'workSession' => $result,
            'tempUserId' => $tempUserId,
            'startTime' => $endTime
        ];
        
        return response()->json($param);
    }
}
