<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[1],
            'category_id' => $row[2],
            'subcategory_id' => $row[3],
            'categoryproduct_id' => $row[4],
            'brand_id' => $row[5],
            'gram' => $row[6],
            'image' => $row[7],
            'description' => $row[8],
            'structure' => $row[9],
            'preparation' => $row[10],
            'new' => $row[11],
            'sale' => $row[12],
            'available' => $row[13],
            'kod' => $row[14],
            'price' => $row[15],
            'old_price' => $row[16],
            'country_id' => $row[17],
            'created_at' => $row[18],
        ]);
    }
}
