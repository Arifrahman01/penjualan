<?php

namespace App\Http\Controllers;

use App\Models\Config\Menu;
use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $menu = Menu::whereNull('parent_id')->with('children')->orderBy('position')->get();
        $request->session()->put('menu', $menu);
        return view('home');
    }
}
