@if (\Filament\Filament::can('viewAny', $this->getModel()))
    <x-filament::card class="space-y-4">
        <h3 class="text-lg font-medium leading-tight">
            {{ __(static::getTitle()) }}
        </h3>

        <div class="items-center justify-between space-y-4 lg:flex lg:space-y-0 lg:space-x-4">
            <div class="space-x-3 flex-shink-0">
                @if ($this->canCreate())
                    <x-filament::button wire:click="openCreate">
                        {{ __(static::$createButtonLabel) }}
                    </x-filament::button>
                @endif

                @if ($this->canAttach())
                    <x-filament::button wire:click="openAttach">
                        {{ __(static::$attachButtonLabel) }}
                    </x-filament::button>
                @endif

                @if ($this->canDetachSelected())
                    <x-filament::button
                        wire:click="openDetach"
                        color="danger"
                        :disabled="count($selected) === 0"
                    >
                        {{ __(static::$detachButtonLabel) }}
                    </x-filament::button>
                @endif

                @if ($this->canDelete())
                    <x-tables::delete-selected :disabled="! $this->canDeleteSelected()" />
                @endif
            </div>

            <x-tables::filter :table="$this->getTable()" />
        </div>

        <x-tables::table
            :records="$records"
            :selected="$selected"
            :sort-column="$sortColumn"
            :sort-direction="$sortDirection"
            :table="$this->getTable()"
        />

        @if ($this->canCreate())
            <x-filament::modal
                class="w-full max-w-4xl"
                :name="static::class . 'RelationManagerCreateModal'"
            >
                <x-filament::card class="space-y-5">
                    <x-filament::card-header :title="static::$createModalHeading" />

                    @livewire(\Livewire\Livewire::getAlias(Filament\Resources\RelationManager\CreateRecord::class), [
                        'cancelButtonLabel' => static::$createModalCancelButtonLabel,
                        'createAnotherButtonLabel' => static::$createModalCreateAnotherButtonLabel,
                        'createButtonLabel' => static::$createModalCreateButtonLabel,
                        'createdMessage' => static::$createModalCreatedMessage,
                        'manager' => static::class,
                        'owner' => $this->owner,
                    ])
                </x-filament::card>
            </x-filament::modal>
        @endif

        <x-filament::modal
            class="w-full max-w-4xl"
            :name="static::class . 'RelationManagerEditModal'"
        >
            <x-filament::card class="space-y-5">
                <x-filament::card-header :title="static::$editModalHeading" />

                @livewire(\Livewire\Livewire::getAlias(Filament\Resources\RelationManager\EditRecord::class), [
                    'cancelButtonLabel' => static::$editModalCancelButtonLabel,
                    'manager' => static::class,
                    'owner' => $this->owner,
                    'saveButtonLabel' => static::$editModalSaveButtonLabel,
                    'savedMessage' => static::$editModalSavedMessage,
                ])
            </x-filament::card>
        </x-filament::modal>

        @if ($this->canAttach())
            <x-filament::modal
                class="w-full max-w-lg"
                :name="static::class . 'RelationManagerAttachModal'"
            >
                <x-filament::card class="w-full space-y-5">
                    <x-filament::card-header :title="static::$attachModalHeading" />

                    @livewire(\Livewire\Livewire::getAlias(Filament\Resources\RelationManager\AttachRecord::class), [
                        'cancelButtonLabel' => static::$attachModalCancelButtonLabel,
                        'attachAnotherButtonLabel' => static::$attachModalAttachAnotherButtonLabel,
                        'attachButtonLabel' => static::$attachModalAttachButtonLabel,
                        'attachedMessage' => static::$attachModalAttachedMessage,
                        'manager' => static::class,
                        'owner' => $this->owner,
                    ])
                </x-filament::card>
            </x-filament::modal>
        @endif

        @if ($this->canDetachSelected())
            <x-filament::modal
                :name="static::class . 'RelationManagerDetachModal'"
            >
                <x-filament::card class="space-y-5">
                    <x-filament::card-header :title="static::$detachModalHeading">
                        <p class="text-sm text-gray-500">
                            {{ __(static::$detachModalDescription) }}
                        </p>
                    </x-filament::card-header>

                    <div class="space-y-3 sm:space-y-0 sm:space-x-3 sm:flex sm:justify-end">
                        <x-filament::button x-on:click="$dispatch('close', '{{ (string) Str::of(get_class($this))->replace('\\', '\\\\') }}RelationManagerDetachModal')">
                            {{ __(static::$detachModalCancelButtonLabel) }}
                        </x-filament::button>

                        <x-filament::button
                            type="button"
                            color="danger"
                            wire:click="detachSelected"
                        >
                            {{ __(static::$detachModalDetachButtonLabel) }}
                        </x-filament::button>
                    </div>
                </x-filament::card>
            </x-filament::modal>
        @endif
    </x-filament::card>
@endif
