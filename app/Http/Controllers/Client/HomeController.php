<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Textpage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data;


    public function index()
    {
        $this->data['slider'] = Slider::with('translate')->first();

        $this->data['about'] = Textpage::getItemInfo(1,locale());

        $this->data['services'] = Service::with(['translate'])->where('status',1)->where('main_page',1)->orderBy('id', 'DESC')->take(3)->get();

        $this->data['rooms'] = ProductCategory::with(['translate','products','products.translate'])->where('status',1)->where('level',2)->get();

        return view('client.home',$this->data);
    }
}
