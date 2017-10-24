<?php

namespace App\Domains\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Core\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin.home');
    }
}
