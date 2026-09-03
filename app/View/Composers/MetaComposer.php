<?php

namespace App\View\Composers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\View\View;

class MetaComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (request()->segment(2) && !request()->segment(3)) {

            $metaTitle = str_replace('-', ' ', request()->segment(2));
        }
        else {
            $metaTitle = 'index';
        }

        if(request()->segment(3))
        {
            switch(request()->segment(2)){
                case 'service':
                    $metaTitle =  Service::with('translate')->findOrFail(request()->segment(3))->translate->title;
                    break;
                case 'room':
                    $metaTitle = Product::with('translate')->findOrFail(request()->segment(3))->translate->title;
                    break;
                case 'contact':
                    $metaTitle = 'contact';
                    break;
            }
        }



        if (isset($metaTitle)) {
            $view->with('metaTitle', $metaTitle);
        }
    }
}
