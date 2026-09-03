<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
    public $data;

    public function index()
    {
        $this->data['rooms'] = ProductCategory::with(['translate'])->where('status', 1)->where('level', 2)->get();

        foreach ($this->data['rooms'] as $room) {
            $room->paginatedProducts = $room->products()->with('translate')->paginate(1);
        }

        return view('client.rooms.index', $this->data);
    }

    public function inner($room)
    {
       $this->data['room'] = Product::where('id',(int)$room)->with(['translate','category','category.translate','images'])->first();

       $this->data['sameRooms'] = Product::with(['translate','category','category.translate'])->whereNotIn('id',[(int)$room])->inRandomOrder()->limit(4)->get();

        return view('client.rooms.inner',$this->data);
    }
}
