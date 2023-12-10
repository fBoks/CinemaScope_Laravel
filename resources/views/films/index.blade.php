@extends('layouts.main')

@section('page.title', 'Фильмы')

@section('main.content')

    <x-title>
        {{ __('Фильмы') }}

        @auth
            @if (Auth::user()->role_id == 'admin')
                <x-slot name="right">
                    <x-button-link href="{{ route('admin.films.create') }}">
                        {{ __('Создать') }}
                    </x-button-link>
                </x-slot>
            @endif
        @endauth
    </x-title>

    @include('films.filter')

    @if ($films->isEmpty())
        {{ __('Нет ни одного фильма') }}
    @else
        <div class="row">
            @foreach ($films as $film)
                <div class="col-12">
                    <x-film.card :film="$film" class="hover-overlay" routePath='films.show'/>
                </div>
            @endforeach
        </div>

        {{ $films->links() }}
    @endif
    
@endsection