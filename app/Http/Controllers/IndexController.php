<?php

namespace App\Http\Controllers;

use App\Mail\UdtExpired;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index($element){
        $machine = Machine::where('serial', $element)->first();
        if($machine){
            return view('welcome',compact('element','machine'));
        }else{
            return redirect()->route('error')
                ->with('fail', 'Nie ma takiej maszyny');
        }
    }
    public function error(){
        return view('error');
    }
}
