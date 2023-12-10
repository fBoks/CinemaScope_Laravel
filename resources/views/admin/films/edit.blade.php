@extends('layouts.main')

@section('page.title', __($film->name))

@section('main.content')

    <x-title>
        {{ __($film->name) }}

        <x-slot name="link">
            <x-back-link href="{{ route('films.show', $film->id) }}"/>
        </x-slot>
    </x-title>

    <x-form action="{{ route('admin.films.update', $film->id) }}" method="PUT">
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-col-12 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Название') }}</x-label>
                        <x-input name="name" value="{{ $film->name }}" id="name" type="text" placeholder="{{ __('Название') }}"/>

                        <x-error name="name" />
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label>{{ __('Слоган') }}</x-label>
                        <x-input name="tagline" value="{{ $film->tagline }}" id="tagline" type="text" placeholder="{{ __('Слоган') }}"/>

                        <x-error name="tagline" /> 
                    </div>

                     <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Выпущен') }}</x-label>
                        <x-input name="realised_at" value="{{ date_format($film->realised_at, 'Y-m-d') }}" type="date" placeholder="{{ __('Выпущен') }}"/>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Жанры') }}</x-label>
                        <select class="form-select" name="genres[]" id="genres" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($genres as $genre)

                                {{ $selected = null }}
                                @foreach ($genres_selected as $selected)
                                    @if ($genre->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Режиссеры') }}</x-label>
                        <select class="form-select" name="directors[]" id="directors" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($directors as $director)

                                {{ $selected = null }}
                                @foreach ($directors_selected as $selected)
                                    @if ($director->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $director->id }}">{{ $director->first_name }} {{ $director->surname }}</option>
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

                                {{ $selected = null }}
                                @foreach ($countries_selected as $selected)
                                    @if ($country->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                        <x-label required>{{ __('Сценаристы') }}</x-label>
                        <select class="form-select" name="screenwriters[]" id="screenwriters" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($screenwriters as $screenwriter)

                                {{ $selected = null }}
                                @foreach ($screenwriters_selected as $selected)
                                    @if ($screenwriter->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $screenwriter->id }}">{{ $screenwriter->first_name }} {{ $screenwriter->surname }}</option>
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

                                {{ $selected = null }}
                                @foreach ($actors_selected as $selected)
                                    @if ($actor->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $actor->id }}">{{ $actor->first_name }} {{ $actor->surname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <x-label required>{{ __('Продюсеры') }}</x-label>
                        <select class="form-select" name="producers[]" id="producers" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                            @foreach ($producers as $producer)

                                {{ $selected = null }}
                                @foreach ($producers_selected as $selected)
                                    @if ($producer->id == $selected->id)
                                        {{ $selected = 'selected' }}
                                        @break
                                    @endif
                                @endforeach

                                <option {{ $selected }} value="{{ $producer->id }}">{{ $producer->first_name }} {{ $producer->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <x-form-item>
            <x-label required>{{ __('Описание') }}</x-label>
            <x-trix name="description" value="{{ $film->description }}"/>

            <x-error name='description' />
        </x-form-item>

        <x-button type="submit" >
            {{ __('Сохранить') }}
        </x-button>
    </x-form>
@endsection

@once
    @push('js')
        <script type="text/javascript" src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    @endpush
@endonce