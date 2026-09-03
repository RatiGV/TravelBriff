<?php

namespace App\Http\Controllers;



use App\Models\Information;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $lang; // მიმდინარე ენა
    protected $config; // json ფაილში შენახული კონფიგურაციული პარამეტრები : ინფორმაცია ქეშირებების შესახებ ...
    protected $available_langs; // ხელმისაწვდომი ენები

    public function __construct(Request $request)
    {
        $this->lang = App::getLocale();
        $this->available_langs = LaravelLocalization::getSupportedLocales();
        $this->config = file_exists(public_path('config.json')) ?
            json_decode(file_get_contents(public_path('config.json')), true) : false;



        View::share('info', Cache::has('info') ? Cache::get('info')[$this->lang] : Information::with('translate')->first());
        View::share('lang', $this->lang);
        View::share('contact_info', Cache::has('informations') ? Cache::get('informations')[$this->lang] : Information::getItemInfo(3, $this->lang));
    }

    public function get_seo($route = null)
    {
        if (Cache::has('seos')) {
            $seo = Cache::get('seos')[$this->lang]->firstWhere('route', $route);
        } else {
            $seo = Seo::getItemInfo($route, $this->lang);
        }

        return $seo;
    }
}
