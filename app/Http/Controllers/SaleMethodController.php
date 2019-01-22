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
}
