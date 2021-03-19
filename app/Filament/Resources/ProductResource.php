<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\UsersRelationManager;
use App\Filament\Roles;
use App\Models\Category;
use App\Models\Product;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class ProductResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')->autofocus()->required(),
                Components\BelongsToSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->primary()->searchable()->sortable(),
                Columns\Text::make('category.name')->searchable()->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            UsersRelationManager::class,
            ImagesRelationManager::class,
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListProducts::routeTo('/', 'index'),
            Pages\CreateProduct::routeTo('/create', 'create'),
            Pages\EditProduct::routeTo('/{record}/edit', 'edit'),
            Pages\SortProducts::routeTo('/sort-products', 'sort-products'),
        ];
    }
}
