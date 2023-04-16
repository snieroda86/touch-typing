<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // kokpit
    public function kokpit(){
        return view('admin.kokpit');
    }
}
