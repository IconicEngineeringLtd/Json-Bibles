<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Artisan;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // Artisan Comands
        // Artisan::call('storage:link');
        // Artisan::call('cache:clear');
        // Artisan::call('route:clear');
        // Artisan::call('config:clear');
        // Artisan::call('view:clear');
        // Artisan::call('optimize:clear');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Role check Developer
        if (Auth::user()->role == 1) {
          return view('developer.dashboard');
        }
        // Role check Supplier
        if (Auth::user()->role == 0 && !empty(Auth::user()->myStore)) {
          return view('supplier.dashboard');
        }
        // Role check User & Customer
        if (Auth::user()->role == 0 && empty(Auth::user()->myStore)) {
          return view('customer.dashboard');
        }
    }
}
