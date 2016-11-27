<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests;

class UserPostController extends Controller
{
    /**
    *文件名(UserPostController.php)
    *
    *根据乘客当前经纬度返回附近可用车的数量
    *
    *@param user_position
    */
    public function carNum($user_position)
    {
        //待完成
        return 10;
    }

    /**
    *根据乘客端输入的乘客人数、路程距离、车型估价
    *
    *@param Request $request
    */
    public function prize(Request $reuqest)
    {
        //待完成
        return 12;
    }

    /**
    *乘客确认用车后，保存订单信息至服务器，用作发布给司机端
    *
    *@param Request $request
    */
    public function orderSave(Request $request)
    {
        $redis = Redis::connection();
        $user_tel = $request->get('user_tel');
        // dd($user_tel);
        // $origin = $request->get('origin');
        // $origin_positon = $request->get('origin_positon');
        // $destination = $request->get('destination');
        // $destination_positon = $request->get('destination_positon');
        // $num = $request->get('num');
        // $cartype = $request->get('cartype');
        $redis->set('user_tel', $user_tel);
        $test = $redis->get('user_tel');
        dd($test);
        return $test;
    }
}
