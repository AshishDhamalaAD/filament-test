<div>
    <x-forms::container :form="$this->getForm()" class="space-y-6">
        <div class="space-x-3">
            <x-filament::button
                type="submit"
                color="primary"
            >
                {{ __($saveButtonLabel) }}
            </x-filament::button>

            <x-filament::button x-on:click="$dispatch('close', '{{ (string) Str::of($manager)->replace('\\', '\\\\') }}RelationManagerEditModal')">
                {{ __($cancelButtonLabel) }}
            </x-filament::button>
        </div>
    </x-forms::container>
</div>
