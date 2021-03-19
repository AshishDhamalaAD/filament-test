<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Posts extends Page
{
    public static $icon = 'heroicon-o-document-text';

    public static $view = 'filament.pages.posts';

    public string $name = "Test post";
}
