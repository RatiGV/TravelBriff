<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\TourCategory;
use App\Models\Slider;
use App\Models\Textpage;

class HomeController extends Controller
{
    public $data;

    public function index()
    {
        $this->data['sliders'] = Slider::with('translate')->where('status',1)->orderBy('sort','asc')->get();

        $this->data['about'] = Textpage::getItemInfo(1,locale());

        $this->data['tourCategories'] = TourCategory::with(['translate','products','products.translate'])->where('status',1)->where('level',2)->get();

        return view('client.home',$this->data);
    }
}
