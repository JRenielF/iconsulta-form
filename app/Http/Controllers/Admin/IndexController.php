<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        // Return a view or perform any logic required for the index page
        return view('admin.index');
    }
}

