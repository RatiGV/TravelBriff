<?php

namespace App\Http\Controllers\Client;

use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

       $this->data['captcha'] = $this->generateCaptcha();

        return view('client.tours.inner',$this->data);
    }

    public function storeOrder(Request $request, $tour)
    {
        $tourId = (int) $tour;

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'persons' => 'required|integer|min:1',
            'arrival_date' => 'nullable|date',
            'return_date' => 'nullable|date|after_or_equal:arrival_date',
            'pickup_location' => 'nullable|string|max:255',
            'return_location' => 'nullable|string|max:255',
            'captcha' => [
                'required',
                Rule::in([(string) session('tour_order_captcha_answer')]),
            ],
        ], [
            'captcha.required' => trans('Please answer the captcha question'),
            'captcha.in' => trans('The captcha answer is incorrect'),
        ]);

        session()->forget('tour_order_captcha_answer');

        TourOrder::create([
            'product_id' => $tourId,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'persons' => $validated['persons'],
            'arrival_date' => $validated['arrival_date'] ?? null,
            'return_date' => $validated['return_date'] ?? null,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'return_location' => $validated['return_location'] ?? null,
        ]);

        return redirect()->route('ClientTourInner', $tour)
            ->with('tour_order_success', true)
            ->withFragment('tour-request-form');
    }

    private function generateCaptcha(): array
    {
        $a = random_int(1, 10);
        $b = random_int(1, 10);

        session(['tour_order_captcha_answer' => $a + $b]);

        return ['a' => $a, 'b' => $b];
    }
}
