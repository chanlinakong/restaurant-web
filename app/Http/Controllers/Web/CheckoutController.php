<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()
            ->addresses()
            ->latest()
            ->get();

        return view('pages.checkout', compact('addresses'));
    }
}