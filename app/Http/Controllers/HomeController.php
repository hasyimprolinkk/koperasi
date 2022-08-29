<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Pinjaman;
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
    public function index()
    {
        $pinjaman = Pinjaman::whereDate('created_at', \Carbon\Carbon::today())->take(5)->latest()->get();
        $kredit = Kredit::whereDate('created_at', \Carbon\Carbon::today())->take(5)->latest()->get();

        return view('home', compact('pinjaman', 'kredit'));
    }
}
