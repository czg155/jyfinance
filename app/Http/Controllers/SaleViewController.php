<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleViewController extends Controller
{
    public function getSale(){
        return view('sale.sale');
    }

    public function addSale(){
        return view('sale.add_sale');
    }

    public function operateSale() {
        return view('sale.operate_sale');
    }
}
