<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;

class Image {
    public static function store($path, $image)
    {
        $imageOriginalName = $image->getClientOriginalName();

        if(Storage::exists("{$path}/$imageOriginalName"))
        {
            $exists = true;
            $i = 1;
            $firstImageName = pathinfo($imageOriginalName, PATHINFO_FILENAME);
            while($exists)
            {
                if(Storage::exists("{$path}/$imageOriginalName"))
                {
                    $imageExtension = pathinfo($imageOriginalName, PATHINFO_EXTENSION);
                    $imageOriginalName = "{$firstImageName}_{$i}.{$imageExtension}";
                    $i++;
                } else {
                    $exists = false;
                }
            }
        }
        return $image->storeAs($path, $imageOriginalName);
    }
}
