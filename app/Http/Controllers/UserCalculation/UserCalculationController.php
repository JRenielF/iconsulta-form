<?php

namespace App\Http\Controllers\UserCalculation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCalculationController extends Controller
{
    public function index()
    {
        // Your index logic here, if needed
        return view('usercalculation.index');
    }

    public function showForm()
    {
        return view('usercalculation.index');
    }

    public function calculate(Request $request)
    {
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $result = $num1 + $num2; // Perform any other calculation here

        return view('usercalculation.index', ['result' => $result]);
    }
}
