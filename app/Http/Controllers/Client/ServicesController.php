<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{

    public function index()
    {
        $services = Service::with('translate')->where('status',1)->get();

        return view('client.services.services',compact('services'));
    }

    public function inner($serviceID)
    {
       $service = Service::with('translate')->where('id',$serviceID)->first();

       $additionalServices = Service::with(['translate'])->whereNotIn('id',[$serviceID])->inRandomOrder()->limit(3)->get();

        return view('client.services.service-inner',compact('service','additionalServices'));
    }
}
