<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Http\Controllers\Controller;

class WheelController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.managespin', compact('rewards'));
    }
}
