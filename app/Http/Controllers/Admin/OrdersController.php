<?php

namespace App\Http\Controllers\Admin;

use App\Models\TourOrder;
use App\Models\TourTranslate;

class OrdersController extends BaseController
{
    public $data = [];

    private $main_table = 'tour_orders';

    public function index()
    {
        $this->data['main_table'] = $this->main_table;
        $this->data['items'] = TourOrder::with('tour')->orderBy('id', 'desc')->get();

        foreach ($this->data['items'] as $item) {
            $item->tour_title = $this->tour_title($item->product_id);
        }

        return view('Administrator.orders.index', $this->data);
    }

    public function show($id)
    {
        $item = TourOrder::with('tour')->find($id);

        if (! $item) {
            return redirect()->route('Orders');
        }

        $item->tour_title = $this->tour_title($item->product_id);

        $this->data['main_table'] = $this->main_table;
        $this->data['item'] = $item;

        return view('Administrator.orders.show', $this->data);
    }

    private function tour_title($product_id)
    {
        if (! $product_id) {
            return null;
        }

        $translate = TourTranslate::where('parent_id', $product_id)->where('lang', $this->configuration->admin_lang)->first();

        return $translate ? $translate->title : null;
    }
}
