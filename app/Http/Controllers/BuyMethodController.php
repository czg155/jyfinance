<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BuyMethodController extends Controller
{
    public function addBuy(Request $request) {
        $inputs = $request->input('inputs');
        $gets = DB::table('buy_attr_relation')->get();

        $attr = [];
        foreach ($gets as $key => $value) {
            if (!in_array($value->company, array_keys($attr))) {
                $attr[$value->company] = [];
            }
            if (!in_array($value->product, array_keys($attr[$value->company]))) {
                $attr[$value->company][$value->product] = [];
            }
            if (!in_array($value->type, array_values($attr[$value->company][$value->product]))) {
                $attr[$value->company][$value->product][] = $value->type;
            }
        }

        $new_attr = [];
        foreach ($inputs as $key => $value) {
            DB::table('buy')->insert(
                [
                    'number' => $value['number'],
                    'date' => $value['date'],
                    'company' => $value['company'],
                    'product' => $value['product'],
                    'type' => $value['type'],
                    'car' => $value['car'],
                    'weight' => $value['weight'],
                    'tip' => $value['tip']
                ]
            );

            //为new_attr填充数据
            if (!in_array($value['company'], array_keys($attr)) || !in_array($value['product'], array_keys($attr[$value['company']])) || !in_array($value['type'], array_values($attr[$value['company']][$value['product']]))) {
                if (!in_array($value['company'], array_keys($new_attr))) {
                    $new_attr[$value['company']] = [];
                }
                if (!in_array($value['product'], array_keys($new_attr[$value['company']]))) {
                    $new_attr[$value['company']][$value['product']] = [];
                }
                if (!in_array($value['type'], array_values($new_attr[$value['company']][$value['product']]))) {
                    $new_attr[$value['company']][$value['product']][] = $value['type'];
                }
            }

        }

        //buy-attr-relation更新
        foreach ($new_attr as $key_company => $value_company) {
            foreach ($value_company as $key_product => $value_product) {
                foreach ($value_product as $key_type => $value_type) {
                    DB::table('buy-attr-relation')->insert(
                        ['company' => $key_company, 'product' => $key_product, 'type' => $value_type]
                    );
                }
            }
        }

        return response()->json(array('sign' => 1));
    }

    public function deleteBuy(Request $request) {
        $inputs = $request->input('inputs');
        DB::table('buy')->where('id', '=', $inputs)->delete();
        return response()->json(array('sign' => 1));
    }

    public function updateBuy(Request $request) {
        $inputs = $request->input('inputs');
        if (empty($inputs)) {
            return response()->json(array('sign' => 0));
        } else {
            $s = 'update buy set ';
            $i = 0;
            foreach ($inputs as $key => $value) {
                if ($key != 'id') {
                    if ($i > 0) {
                        $s = $s . ',' . $key . '=' . '"' . $value . '"';
                    } else {
                        $s = $s . '' . $key . '=' . '"' . $value . '"';
                    }
                    $i = $i + 1;
                }
            }
            $s = $s . 'where buy.id=' . $inputs['id'];
            DB::update($s);
            return response()->json(array('sign' => 1));
        }
    }

    public function sortAttrBuy()
    {
        $gets = DB::table('buy_attr_relation')->get();
        $attr_all = [];
        $attr_product_type = [];
        foreach ($gets as $key => $value) {
            if (!in_array($value->company, array_keys($attr_all))) {
                $attr_all[$value->company] = [];
            }
            if (!in_array($value->product, array_keys($attr_all[$value->company]))) {
                $attr_all[$value->company][$value->product] = [];
            }
            if (!in_array($value->type, array_values($attr_all[$value->company][$value->product]))) {
                $attr_all[$value->company][$value->product][] = $value->type;
            }

            //$attr_product_type赋值
            if (!in_array($value->product, array_keys($attr_product_type))) {
                $attr_product_type[$value->product] = [];
            }
            if (!in_array($value->type, array_values($attr_product_type[$value->product]))) {
                $attr_product_type[$value->product][] = $value->type;
            }
        }
        return response()->json(array('sign' => 1, 'attr_all' => $attr_all, 'attr_product_type' => $attr_product_type));
    }

    public function selBuy(Request $request)
    {
        $inputs = $request->input('inputs');
        $s = 'select * from buy';
        $b = 1;
        foreach ($inputs as $key => $value) {

            switch ($key) {
                case 'beginTime':
                    if (!empty($value)) {
                        if ($b) {
                            $s = $s . ' where ';
                            $b = 0;
                        } else {
                            $s = $s . ' and ';
                        }
                        $s = $s . 'date>="' . $value . '"';
                    }
                    break;
                case 'endTime':
                    if (!empty($value)) {
                        if ($b) {
                            $s = $s . ' where ';
                            $b = 0;
                        } else {
                            $s = $s . ' and ';
                        }
                        $s = $s . 'date<="' . $value . '"';
                    }
                    break;
                default:
                    if (!empty($value) && $value != -1) {
                        if ($b) {
                            $s = $s . ' where ';
                            $b = 0;
                        } else {
                            $s = $s . ' and ';
                        }
                        $s = $s . $key . '="' . $value . '"';
                    }
                    break;
            }

        }
        // return $s;
        $get_data = DB::select($s);
        $data = array();
        foreach ($get_data as $key => $value) {
            $v['id'] = $value->id;
            $v['number'] = $value->number;
            $t = strtotime($value->date);
            $v['date'] = date("Y-m-d", $t);
            $v['company'] = $value->company;
            $v['product'] = $value->product;
            $v['type'] = $value->type;
            $v['car'] = $value->car;
            $v['weight'] = $value->weight;
            $v['tip'] = $value->tip;
            $data[] = $v;
        }
        return response()->json(array('sign' => 1, 'inputs' => $data));
    }

    public function addPriceBuy(Request $request) {
        $inputs = $request->input('inputs');
        if (empty($inputs)) {
            return response()->json(array('sign' => 2));
        }
        foreach ($inputs as $key => $value) {
            DB::table('buy_price')->insert(
                [
                    'company' => $value['company'],
                    'product' => $value['product'],
                    'type' => $value['type'],
                    'begin' => $value['begin'],
                    'end' => $value['end'],
                    'price' => $value['price'],
                    'tip' => $value['tip']
                ]
            );
        }

        return response()->json(array('sign' => 1));
    }

    public function selPrice(Request $request)
    {
        $inputs = $request->input('inputs');
        $s = 'select * from buy_price';
        $b = 1;
        foreach ($inputs as $key => $value) {
            if (!empty($value) && $value != -1) {
                if ($b) {
                    $s = $s . ' where ';
                    $b = 0;
                } else {
                    $s = $s . ' and ';
                }
                $s = $s . $key . '="' . $value . '"';
            }
        }
        // return $s;
        $get_data = DB::select($s);
        $data = array();
        foreach ($get_data as $key => $value) {
            $v['id'] = $value->id;
            $v['company'] = $value->company;
            $v['product'] = $value->product;
            $v['type'] = $value->type;
            $t = strtotime($value->begin);
            $v['begin'] = date("Y-m-d", $t);
            $t = strtotime($value->end);
            $v['end'] = date("Y-m-d", $t);
            $v['price'] = $value->price;
            $v['tip'] = $value->tip;
            $data[] = $v;
        }
        return response()->json(array('sign' => 1, 'inputs' => $data));
    }

    public function stateMaterialBuy(Request $request)
    {
        $inputs = $request->input('inputs');

        if (empty($inputs['begin']) && empty($inputs['end'])) {
            return response()->json(array('sign' => 2));
        }
        $gets = DB::table('buy')
            ->select('company', 'product', 'type', 'weight')
            ->where([
                ['date', '>=', $inputs['begin']],
                ['date', '<=', $inputs['end']],])
            ->get();

        $data = [];
        foreach ($gets as $key => $value) {
            if (!in_array($value->company, array_keys($data))) {
                $data[$value->company] = [];
            }
            if (!in_array($value->product, array_keys($data[$value->company]))) {
                $data[$value->company][$value->product] = [];
            }
            if (!in_array($value->type, array_keys($data[$value->company][$value->product]))) {
                $data[$value->company][$value->product][$value->type] = 0;
            }
            $data[$value->company][$value->product][$value->type] += $value->weight;
        }

        return response()->json(array('sign' => 1, 'inputs' => $data));
    }

}