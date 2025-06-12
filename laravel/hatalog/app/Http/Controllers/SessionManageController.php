<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SessionManageService;

class SessionManageController extends Controller
{
     protected $service;

    public function __construct(SessionManageService $service)
    {
        $this->service = $service;
    }

    // Top画面表示
    public function start() {
        $test = $this->service->create();
        $param = [
            'result' => $test,
        ];

        
        return response()->json($param);
    }
}
