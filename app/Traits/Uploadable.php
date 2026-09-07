<?php

namespace App\Traits;

trait Uploadable
{
    public static function uploadFile($request, $data)
    {
        $file = $request->file($data['column_name']);

        $destination = 'uploads/'.$data['upload_folder'];

        if (! file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $fileName = mt_rand(11111, 99999).time().'.'.$file->getClientOriginalExtension();

        $file->move($destination, $fileName);

        $data['item']->{$data['column_name']} = '/'.$destination.'/'.$fileName;

        return true;
    }

    public static function uploadGalleryImage($request, $file, $item, $class_base_name, $gallery_table = null)
    {
        $destination = 'uploads/'.$class_base_name.'/gallery';

        if (! file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $fileName = mt_rand(11111, 99999).time().'.'.$file->getClientOriginalExtension();

        $file->move($destination, $fileName);

        return $item->images()->create([
            'image' => '/'.$destination.'/'.$fileName,
        ]);
    }
}
