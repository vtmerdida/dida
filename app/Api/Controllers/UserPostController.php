<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests;

class UserPostController extends BaseController
{

    /**
    *文件名(UserPostController.php)
    *
    *根据乘客当前经纬度返回附近可用车的数量
    *
    *@param $request
    */

    public function carNum(Request $request)
    {
        //获得乘客经纬度
        $position = $request->get('position');
        //以逗号拆分经纬度，存为一个数组，0为经度，1为纬度
        $p_data = explode(",", $position);
        //查询司机手机号码，作为查询司机位置的遍历依据
        $drivers = Redis::sinter('driverphone');
        $num = 0;//车辆统计个数num
        foreach ($drivers as $driver) {
            //
            $d_position = Redis::hget('driverphone'.$driver, 'position');
            $d_data = explode(",", $d_position);
            $betweenX = $p_data['0']-$d_data['0'];
            $betweenY = $p_data['1']-$d_data['1'];

            /***满足经纬度加减0.02(实际距离为2.2公里)的范围的车辆则算入统计***/
            if (abs($betweenX)<=0.02&&abs($betweenY)<=0.02) {
                $num = $num+1;
            }
        }
        return $num;
    }

    /**
    *根据乘客端输入的乘客人数、路程距离、车型估价(目前只根据路程)
    *
    *@param $request
    */

    public function price(Request $request)
    {
        $distance = $request->get('distance');
        if ($distance<=5) {
                return 5;
        } else {
            $p = 5+0.5*($distance-5);
            return $p;
        }
    }

    /**
    *乘客确认用车后，保存订单信息至服务器，用作发布给司机端
    *
    *用车表名称格式
    *
    *@param Request $request
    */

    public function orderSave(Request $request)
    {
        $redis = Redis::connection();
        //获得用户手机号码
        $userphone = $request->get('userphone');
        //存入userphone集合
        $userphone_save = Redis::sadd('userphone', $userphone);
        // dd($userphone);
        //获取集合userphone里的全部手机号码
         // $value = Redis::command('sinter', ['userphone']);
         // dd($value);
        //获得出发地名称
        $fromname = $request->get('fromname');
        //获得出发地经纬度
        $fromgeog = $request->get('fromgeog');
        //获得目的地名称
        $destination = $request->get('destination');
        //获得目的地经纬度
        $destination_positon = $request->get('destination_positon');
        //获得乘客人数
        $num = $request->get('num');
        //获得车类型
        $cartype = $request->get('cartype');
        $isAccept = 0;
        
        $query = Redis::hmset(
            'usecar:'.$userphone,
            ['fromname',
            $fromname,
            'fromgeog',
            $fromgeog,
            'destination',
            $destination,
            'destination_positon',
            $destination_positon,
            'num',
            $num,
            'cartype',
            $cartype,
            'isAccept',
            $isAccept
            ]
        );
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
}
