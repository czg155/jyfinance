<?php

namespace App\Http\Controllers;

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
        return view('buy.buy');
    }

    public function operateBuy() {
        return view('buy.operate_buy');
    }

    public function priceBuy()
    {
        return view('buy.price_buy');
    }

    public function stateBuy()
    {
        return view('buy.state_buy');
    }

}