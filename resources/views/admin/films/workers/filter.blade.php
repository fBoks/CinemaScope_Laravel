<x-form action="{{ url()->current() }}" method="GET">
    <x-errors/>

    <div class="row">
        <div class="col-md-12 сol-12">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="mb-2">
                        <x-input-floating-label name="search" id="floatingSearch" value="{{ request('search') }}" placeholder="{{ __('Поиск') }}">
                            {{ __('Поиск') }}
                        </x-input-floating-label>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="mb-2">
                        <div class="form-floating">
                            <x-select name="role_id" id="floatingRoleId" value="{{ request('role_id') }}" nullOptionName="Все должности" :options="$roles"/> 
                            <label for="floatingRoleId">{{ __('Должность') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="mb-4">
                <x-button type="submit" class="w-100">
                    {{ __('Найти') }}
                </x-button>
            </div>
        </div>
    </div>
</x-form>

@push('js')
    <script type="text/javascript" src="{{ asset('js/multiselect-dropdown.js') }}"></script>
@endpush 