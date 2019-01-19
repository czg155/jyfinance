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

        foreach ($new_attr as $key_company => $value_company) {
            foreach ($value_company as $key_product => $value_product) {
                foreach ($value_product as $key_type => $value_type) {
                    DB::table('buy-attr-relation')->insert(
                        ['company' => $key_company, 'product' => $key_product, 'type' => $value_type]
                    );
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
        $gets = DB::table('buy-attr-relation')->get();
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

}