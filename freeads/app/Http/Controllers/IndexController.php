<?php

namespace freeads\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }
}
