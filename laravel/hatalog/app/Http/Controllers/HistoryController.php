<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoryService;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    protected $service;

    public function __construct(HistoryService $service)
    {
        $this->service = $service;
    }

    // 勤務履歴画面表示
    public function index() {
        $userId = Auth::id();
        $this->service->getSorkSessionHistory($userId);
        return view('history');
    }
}
