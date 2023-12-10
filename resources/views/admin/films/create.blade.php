@extends('layouts.main')

@section('page.title', __('Фильм - создать'))

@section('main.content')

    <x-title>
        {{ __('Фильм - создать') }}

        <x-slot name="link">
            <x-back-link href="{{ url()->previous() }}"/>
        </x-slot>
    </x-title>

    <x-form action="{{ route('admin.films.store') }}" method="POST">
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-col-12 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Название') }}</x-label>
                        <x-input name="name" id="name" type="text" placeholder="{{ __('Название') }}"/>

                        <x-error name="name" />
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label>{{ __('Слоган') }}</x-label>
                        <x-input name="tagline" id="tagline" type="text" placeholder="{{ __('Слоган') }}"/>

                        <x-error name="tagline" /> 
                    </div>

                     <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Выпущен') }}</x-label>
                        <x-input name="realised_at" type="date" placeholder="{{ __('Выпущен') }}"/>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Жанры') }}</x-label>
                        <select class="form-select" name="genres[]" id="genres" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Режиссеры') }}</x-label>
                        <select class="form-select" name="directors[]" id="directors" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($directors as $director)
                                <option value="{{ $director->id }}">{{ $director->first_name }} {{ $director->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Страны') }}</x-label>
                        <select class="form-select" name="countries[]" id="countries" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Сценаристы') }}</x-label>
                        <select class="form-select" name="screenwriters[]" id="screenwriters" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($screenwriters as $screenwriter)
                                <option value="{{ $screenwriter->id }}">{{ $screenwriter->first_name }} {{ $screenwriter->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Актеры') }}</x-label>
                        <select class="form-select" name="actors[]" id="actors" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($actors as $actor)
                                <option value="{{ $actor->id }}">{{ $actor->first_name }} {{ $actor->surname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Продюсеры') }}</x-label>
                        <select class="form-select" name="producers[]" id="producers" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($producers as $producer)
                                <option value="{{ $producer->id }}">{{ $producer->first_name }} {{ $producer->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <x-form-item>
            <x-label required>{{ __('Описание') }}</x-label>
            <x-trix name="description"/>

            <x-error name='description' />
        </x-form-item>

        <x-button type="submit" >
            {{ __('Создать') }}
        </x-button>
    </x-form>
@endsection

@once
    @push('js')
        <script type="text/javascript" src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    @endpush
@endonce