<?php

use App\Models\Information;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use GuzzleHttp\Client;

function locale()
{
    return LaravelLocalization::getCurrentLocale();
}

function information()
{
    $info = Information::with('translate')->first();

    return $info;
}

function createSlug($title)
{

    if(!empty($title)){
        $title =  str_replace(' ','-',$title);

        return $title;
    }

    return '';
}
