<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $machines = Machine::get();
        return view('dashboard', compact('machines'));
    }
}
