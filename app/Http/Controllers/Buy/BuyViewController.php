<?php

namespace App\Http\Controllers\Buy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BuyViewController extends Controller
{
    public function test(Request $request) {
        $gets = DB::table('buy-attr-relation')->get();

        $attr = array();
        // return array_values($attr);

        foreach ($gets as $key => $value) {
            if (!in_array($value->company, array_values($attr))) {
                $attr[$value->company] = [];
            }
            if (!in_array($value->product, array_values($attr[$value->company]))) {
                $attr[$value->company][$value->product] = [];
            }
            if (!in_array($value->type, array_values($attr[$value->company][$value->product]))) {
                $attr[$value->company][$value->product][$value->type] = [$value->type];
            }
        }
        return view('test', ['array' => $attr]);
    }

    public function getBuy(){
        // //查询数据库，获取数据库原始数据
        // $gets = DB::select('select * from buy');

        // //将原始数据处理
        // $array = null;
        // $arr_length = sizeof($gets);

        // for ($i=0; $i < $arr_length; $i++) { 
        //     $array[$i]['id'] = $gets[$i]->id;
        //     $array[$i]['number'] = $gets[$i]->number;
        //     $array[$i]['date'] = $gets[$i]->date;
        //     $array[$i]['company'] = $gets[$i]->company;
        //     $array[$i]['product'] = $gets[$i]->product;
        //     $array[$i]['type'] = $gets[$i]->type;
        //     $array[$i]['car'] = $gets[$i]->car;
        //     $array[$i]['weight'] = $gets[$i]->weight;
        //     $array[$i]['tip'] = $gets[$i]->tip;
        // }

        // print_r ($array);
        
        return view('buy.buy');
    }

    public function operateBuy() {
        return view('buy.operate_buy');
    }

}