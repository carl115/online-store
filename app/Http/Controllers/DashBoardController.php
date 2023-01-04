<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function viewTableProduct() {
        return view('dasboard.tableProducts');
    }

    public function viewTablePurchases() {
        return view('dasboard.tablePurchases');
    }

    public function viewTableCategories() {
        return view('dasboard.tableCategories');
    }

    public function viewTableUsers() {
        return view('dasboard.tableUsers');
    }
}
