<?php

namespace App\Http\Controllers\Client;

use App\Models\Tour;
use App\Models\TourCategory;
use App\Http\Controllers\Controller;

class ToursController extends Controller
{
    public $data;

    public function index()
    {
        $this->data['categories'] = TourCategory::with(['translate'])->where('status', 1)->where('level', 2)->get();

        foreach ($this->data['categories'] as $category) {
            $category->paginatedTours = $category->products()->with('translate')->paginate(9);
        }

        return view('client.tours.index', $this->data);
    }

    public function inner($tour)
    {
       $this->data['tour'] = Tour::where('id',(int)$tour)->with(['translate','category','category.translate','images'])->first();

       $this->data['sameTours'] = Tour::with(['translate','category','category.translate'])->whereNotIn('id',[(int)$tour])->inRandomOrder()->limit(4)->get();

        return view('client.tours.inner',$this->data);
    }
}
