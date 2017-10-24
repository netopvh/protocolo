<?php

namespace App\Domains\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Core\Http\Controllers\Controller;
use Jenssegers\Date\Date;

class HomeController extends Controller
{

    private $servidorRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return mixed
     */
    public function index()
    {
        Date::setLocale(config('app.locale'));

         return view('home')
                ->with('data',Date::now()->format('l j F Y H:i:s'));
    }
}
