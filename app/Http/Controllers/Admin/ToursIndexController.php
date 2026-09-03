<?php

namespace App\Http\Controllers\Admin;

class ToursIndexController extends BaseController
{
    public function index()
    {
        return view('Administrator.tours.index');
    }
}
