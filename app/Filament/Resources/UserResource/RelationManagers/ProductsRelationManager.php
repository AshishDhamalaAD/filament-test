<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Product;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    public static $primaryColumn = 'name';

    public static $relationship = 'orders';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Select::make('product_id')
                    ->options($options = Product::pluck('name', 'id')),
                Components\Select::make('status')
                    ->options($options = ['active' => 'Active', 'inactive' => 'Inactive']),
                Components\DatePicker::make('delivered_at')
                    ->displayFormat($format = 'F j, Y')
                    ->format($format = 'Y-m-d H:i:s')
                    ->maxDate(now()->addMonth())
                    ->minDate(now()),
                // delivered_at
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('product.name')->searchable()->sortable(),
                Columns\Text::make('status')->searchable()->sortable(),
                Columns\Text::make('delivered_at')->searchable()->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
