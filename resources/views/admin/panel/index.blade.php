@extends('layouts.main')

@section('page.title', 'Админ - панель')

@section('main.content')
    <x-title>
        {{ __('Админ - панель') }}
    </x-title>

    <h5 class="mb-3">
        Добавить, изменить, удалить
    </h5>

    <div class="d-grid gap-2 col-12">
        <x-button-link href="{{ route('admin.countries') }}" class="d-grid">
            {{ __('Страны') }}
        </x-button-link>

        <x-button-link href="{{ route('admin.films.genres') }}" class="d-grid">
            {{ __('Жанры') }}
        </x-button-link>

        <x-button-link href="{{ route('admin.films.workers') }}" class="d-grid">
            {{ __('Работники кино') }}
        </x-button-link>
    </div>
@endsection