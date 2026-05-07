<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('pages.home', compact('pakets'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function menu()
    {
        $pakets = Paket::orderBy('kategori')->orderBy('harga_paket')->get();
        return view('pages.menu', compact('pakets'));
    }

    public function pricing()
    {
        $pakets = Paket::all();
        return view('pages.pricing', compact('pakets'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
