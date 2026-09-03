<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Textpage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = Textpage::getItemInfo(1,locale());

        return view('client.about',compact('about'));
    }
}
