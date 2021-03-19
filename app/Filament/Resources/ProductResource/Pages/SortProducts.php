<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\Page;

class SortProducts extends Page
{
    public static $resource = ProductResource::class;

    public static $view = 'filament.resources.product-resource.pages.sort-products';
}
