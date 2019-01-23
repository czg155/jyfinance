<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleMethodController extends Controller
{
    public function addSale(Request $request) {
        $inputs = $request->input('inputs');
        $gets = DB::table('sale_attr_relation')->get();

        $attr = [];

        foreach ($gets as $key => $value) {
        	if (!in_array($value->project, array_keys($attr))) {
        		$attr[$value->project] = [];
        	}
        	if (!in_array($value->product, $attr[$value->project])) {
        		$attr[$value->project][] = $value->product;
        	}
        }

        $new_attr = [];

        foreach ($inputs as $key => $value) {
            DB::table('sale')->insert(
                [
                    'number' => $value['number'],
                    'date' => $value['date'],
                    'company' => $value['company'],
                    'project' => $value['project'],
                    'part' => $value['part'],
                    'product' => $value['product'],
                    'weight' => $value['weight'],
                    'car' => $value['car'],
                    'carindex' => $value['carindex'],
                    'tip' => $value['tip']
                ]
            );

            if (!in_array($value['project'], array_keys($attr)) || !in_array($value['product'], $attr[$value['project']])) {
        		if (!in_array($value['project'], array_keys($new_attr))) {
        			$new_attr[$value['project']] = [];
        		}
        		if (!in_array($value['product'], $new_attr[$value['project']])) {
        			$new_attr[$value['project']][] = $value['product'];
        		}
        	}
        }

        foreach ($new_attr as $key_project => $value_project) {
        	foreach ($value_project as $key_product => $value_product) {
        		DB::table('sale_attr_relation')->insert(
                        ['project' => $key_project, 'product' => $value_product]
                    );
        	}
        }

        return response()->json(array('sign' => 1));
    }

    public function selAttrSale()
    {
        $gets = DB::table('sale_attr_relation')->get();
        $attr = [];
        foreach ($gets as $key => $value) {
            if (!in_array($value->project, array_keys($attr))) {
                $attr[$value->project] = [];
            }
            if (!in_array($value->product, $attr[$value->project])) {
                $attr[$value->project][] = $value->product;
            }
        }
        return response()->json(array('sign' => 1, 'attr' => $attr));
    }

    public function selSale(Request $request)
    {
        $inputs = $request->input('inputs');
        $s = 'select * from sale';
        $b = 1;
        foreach ($inputs as $key => $value) {

            switch ($key) {
                case 'begin':
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
                case 'end':
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
            $v['project'] = $value->project;
            $v['part'] = $value->part;
            $v['product'] = $value->product;
            $v['weight'] = $value->weight;
            $v['car'] = $value->car;
            $v['carindex'] = $value->carindex;
            $v['tip'] = $value->tip;
            $data[] = $v;
        }
        return response()->json(array('sign' => 1, 'inputs' => $data));
    }

    public function deleteSale(Request $request) {
        $inputs = $request->input('inputs');
        DB::table('sale')->where('id', '=', $inputs)->delete();
        return response()->json(array('sign' => 1));
    }

    public function updateSale(Request $request) {
        $inputs = $request->input('inputs');
        if (empty($inputs)) {
            return response()->json(array('sign' => 0));
        } else {
            $s = 'update sale set ';
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
            $s = $s . 'where sale.id=' . $inputs['id'];
            DB::update($s);
            return response()->json(array('sign' => 1));
        }
    }
}
