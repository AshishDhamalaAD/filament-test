<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ImagesRelationManager extends RelationManager
{
    public static $primaryColumn = '';

    public static $relationship = 'images';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\FileUpload::make('image')->image(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Image::make('image')->height($height = 40),
                // Columns\Text::make('image')
                //     ->formatUsing(function ($value) {
                //         return '<img src="' . Storage::url($value) . '"/>';
                //     }),
            ])
            ->filters([
                //
            ]);
    }
}
