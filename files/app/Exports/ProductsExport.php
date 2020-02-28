<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class ProductsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{

    public function query()
    {
        return Product::select(
            'id', 'name', 'category_id', 'subcategory_id', 'categoryproduct_id',
            'brand_id', 'gram', 'image', 'description', 'structure', 'preparation',
            'new', 'sale', 'available', 'kod', 'price', 'old_price', 'created_at', 'country_id'
        );
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->category->id,
            $product->subcategory->id,
            $product->categoryproduct->id,
            $product->brand->id,
            $product->gram,
            $product->image,
            $product->description,
            $product->structure,
            $product->preparation,
            $product->new,
            $product->sale,
            $product->available,
            $product->kod,
            $product->price,
            $product->old_price,
            $product->country->id,
            Date::dateTimeToExcel($product->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            '№(id)',
            'Название товара',
            'Категория',
            'Под категория',
            'Категория продуктов',
            'Бренд',
            'Масса',
            'Изображения',
            'О товаре',
            'Состав',
            'Способ приготовления',
            'Новинка',
            'На распродажу',
            'В наличие',
            'Код товара',
            'Цена товара (сом)',
            'Новая цена товара (сом)',
            'Страна производства',
            'Дата создания товара'
        ];
    }

    public function columnFormats(): array
    {
        return [
          'S' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
