<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    public function index()
    {
        return view('hr.dashboard');
    }
}
