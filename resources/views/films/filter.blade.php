<x-form action="{{ url()->current() }}" method="GET">
    <x-errors/>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12 col-sm-12">
                <div class="mb-2">
                    <x-input-floating-label name="search" id="floatingSearch" value="{{ request('search') }}" placeholder="{{ __('Поиск') }}">
                        {{ __('Поиск') }}
                    </x-input-floating-label>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="mb-2">
                    <div class="form-floating">
                        <x-select name="genre_id" id="floatingGenreId" value="{{ request('genre_id') }}" nullOptionName="Все жанры" :options="$genres" /> 
                        <label for="floatingGenreId">{{ __('Категория') }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="col-md-12 col-sm-12">
                <div class="mb-2">
                    <x-input-floating-label name="from_date" id="fromDateFloating" type="date" value="{{ request('from_date') }}" placeholder="{{ __('Дата от:') }}">
                        {{ __('Дата от:') }}
                    </x-input-floating-label>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="mb-2">
                    <x-input-floating-label name="to_date" id="toDateFloating" type="date" value="{{ request('to_date') }}" placeholder="{{ __('Дата до:') }}">
                        {{ __('Дата до:') }}
                    </x-input-floating-label>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
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