<?php

namespace App\Http\Controllers\Buy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BuyMethodController extends Controller
{
    public function addBuy(Request $request) {
        $inputs = $request->input('inputs');
        $gets = DB::table('buy-attr-relation')->get();

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
            // DB::insert('insert into buy (number, date, company, product, type, car, weight, tip) values (?, ?, ?, ?, ?, ?, ?, ?)', [$value['number'], $value['date'], $value['company'], $value['product'], $value['type'], $value['car'], $value['weight'], $value['tip']]);

            //根据数据库中的buy_product表(id, product, company)，若有新的product，
            //则存为$new_product[product] = company;键为product，值为对应的company

            if (!in_array($value['company'], array_keys($attr)) || !in_array($value['product'], array_keys($attr[$value['company']])) || !in_array($value['type'], array_values($attr[$value['company']][$value['product']]))) {
                if (!in_array($value['company'], array_keys($new_attr))) {
                    $new_attr[$value['company']][$value['product']][] = $value['type'];
                } else {
                    if (!in_array($value['product'], array_keys($new_attr['company']))) {
                        $new_attr[$value['company']][$value['product']][] = $value['type'];
                    } else {
                        if (!in_array($value['type'], array_value($new_attr['company']['type']))) {
                            $new_attr[$value['company']][$value['product']][] = $value['type'];
                        }
                    }
                }
            }
            //////////////////////////////////////////////////////////////////////////
            //It is 上面if(..||..||..||)的展开，若上面if报错用这段
            // if (!in_array($value['company'], array_keys($attr))) {
            //     if (!in_array($value['company'], array_keys($new_attr))) {
            //         $new_attr[$value['company']][$value['product']][] = $value['type'];
            //     } else {
            //         if (!in_array($value['product'], array_keys($new_attr['company']))) {
            //             $new_attr[$value['company']][$value['product']][] = $value['type'];
            //         } else {
            //             if (!in_array($value['type'], array_value($new_attr['company']['type']))) {
            //                 $new_attr[$value['company']][$value['product']][] = $value['type'];
            //             }
            //         }
            //     }
            // } else {
            //     if (!in_array($value['product'], array_keys($attr[$value['company']]))) {
            //         if (!in_array($value['company'], array_keys($new_attr))) {
            //             $new_attr[$value['company']][$value['product']][] = $value['type'];
            //         } else {
            //             if (!in_array($value['product'], array_keys($new_attr['company']))) {
            //                 $new_attr[$value['company']][$value['product']][] = $value['type'];
            //             } else {
            //                 if (!in_array($value['type'], array_value($new_attr['company']['type']))) {
            //                     $new_attr[$value['company']][$value['product']][] = $value['type'];
            //                 }
            //             }
            //         }
            //     } else {
            //         if (!in_array($value['type'], array_values($attr[$value['company']][$value['product']]))) {
            //             if (!in_array($value['company'], array_keys($new_attr))) {
            //                 $new_attr[$value['company']][$value['product']][] = $value['type'];
            //             } else {
            //                 if (!in_array($value['product'], array_keys($new_attr['company']))) {
            //                     $new_attr[$value['company']][$value['product']][] = $value['type'];
            //                 } else {
            //                     if (!in_array($value['type'], array_value($new_attr['company']['type']))) {
            //                         $new_attr[$value['company']][$value['product']][] = $value['type'];
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // }
            /////////////////////////////////////////////////////////////////////////
        }

        //为buy_company, buy_product, buy_type中不存在的值更新属性。
        // foreach ($new_company as $key => $value) {
        //     DB::insert('insert into buy_company (company) values (?)', [$value]);
        // }
        // foreach ($new_product as $key => $value) {
        //     DB::insert('insert into buy_product (product, company) values (?, ?)', [$key, $value]);
        // }
        // foreach ($new_type as $key => $value) {
        //     DB::insert('insert into buy_type (type, product) values (?, ?)', [$key, $value]);
        // }

        foreach ($attr as $key_company => $value_company) {
            foreach ($value_company as $key_product => $value_product) {
                foreach ($value_product as $key_type => $value_type) {
                    print($key_company. '------' . $key_product. '-------' .$value_type);
                    print('<br>');
                }
            }
        }
        print('<br>');
        print('<-------------------------->');
        print('<br>');
        foreach ($new_attr as $key_company => $value_company) {
            foreach ($value_company as $key_product => $value_product) {
                foreach ($value_product as $key_type => $value_type) {
                    print($key_company. '------' .$key_product. '-------' .$value_type);
                    print('<br>');
                }
            }
        }
        return 0;
    }

    public function deleteBuy(Request $request) {
        $inputs = $request->input('inputs');
        $deleted = DE::delete('delete from buy where id = ?', [$inputs]);
        return 0;
    }

    public function updateBuy(Request $request) {
        $inputs = $request->input('inputs');
        $affected = DB::update('update buy set ');
    }

    public function sortAttrBuy()
    {
        // $get_companys = DB::select('select company from buy_company');
        // $get_products = DB::select('select product, company from buy_product');
        // $get_types = DB::select('select type, product from buy_type');
        $company = [];
        $product = array();
        $type = array();
        foreach ($get_companys as $key => $value) {
            $company[] = $value->company;
            $product[$value->company] = [];
        }
        foreach ($get_products as $key => $value) {
            $product[$value->company][] = $value->product;
            $type[$value->product] = [];
        }
        foreach ($get_types as $key => $value) {
            $type[$value->product][] = $value->type;
        }
        return response()->json(array('sign' => 1, 'inputs_company' => $company, 'inputs_product' => $product, 'inputs_type' => $type));
    }

    public function selBuy(Request $request)
    {
        $inputs = $request->input('inputs');
        $s = 'select * from buy';
        $b = 1;
        foreach ($inputs as $key => $value) {
            if ($key == 'beginTime') {
                if (!empty($value)) {
                    if ($b) {
                        $s = $s . ' where ';
                        $b = 0;
                    } else {
                        $s = $s . ' and ';
                    }
                    $s = $s . 'date>="' . $value . '"';
                }
            } elseif ($key == 'endTime'){
                if (!empty($value)) {
                    if ($b) {
                        $s = $s . ' where ';
                        $b = 0;
                    } else {
                        $s = $s . ' and ';
                    }
                    $s = $s . 'date<="' . $value . '"';
                }
            } else {
                if (!empty($value)) {
                    if ($b) {
                        $s = $s . ' where ';
                        $b = 0;
                    } else {
                        $s = $s . ' and ';
                    }
                    $s = $s . $key . '="' . $value . '"';
                }
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

}