<?php

namespace Filament\Resources\Pages;

use Filament\Filament;
use Filament\Forms\HasForm;
use Filament\Resources\Forms\Form;
use Illuminate\Support\Str;

class CreateRecord extends Page
{
    use HasForm;

    public static $createButtonLabel = 'filament::resources/pages/create-record.buttons.create.label';

    public $record;

    public static $showRoute = 'edit';

    public static $view = 'filament::resources.pages.create-record';

    public function create()
    {
        $this->callHook('beforeValidate');

        $this->validateTemporaryUploadedFiles();

        $this->storeTemporaryUploadedFiles();

        $this->validate();

        $this->callHook('afterValidate');

        $this->callHook('beforeCreate');

        $this->record = static::getModel()::create($this->record);

        $this->callHook('afterCreate');

        $this->redirect($this->getResource()::generateUrl(static::$showRoute, [
            'record' => $this->record,
        ]));
    }

    public static function getBreadcrumbs()
    {
        return [
            static::getResource()::generateUrl() => (string) Str::title(static::getResource()::getPluralLabel()),
        ];
    }

    public function getForm()
    {
        return static::getResource()::form(
            Form::make()
                ->context(static::class)
                ->model(static::getModel())
                ->record($this->record)
                ->submitMethod('create'),
        );
    }

    public function isAuthorized()
    {
        return Filament::can('create', static::getModel());
    }

    public function mount()
    {
        $this->record = [];

        $this->callHook('beforeFill');

        $this->fillWithFormDefaults();

        $this->callHook('afterFill');
    }
}
