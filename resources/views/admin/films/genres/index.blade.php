@extends('layouts.main')

@section('page.title', 'Админ - жанры фильмов')

@section('main.content')
    
    <x-title>
        {{ __('Админ - жанры фильмов') }}

        <x-slot name="link">
            <x-back-link href="{{ route('admin.panel') }}"/>
        </x-slot>
    </x-title>

    {{-- Фильтр --}}
    <div class="mb-3 ">
        <div class="d-flex justify-content-between gap-1">
            <x-form action="{{ url()->current() }}" method="GET" class="w-100 m-0">
                <div class="d-flex justify-content-between gap-2 grow-1">
                    <x-input name="search" id="search" value="{{ request('search') }}" placeholder="{{ __('Поиск') }}"/>

                    <x-button type="submit">
                        {{ __('Найти') }}
                    </x-button>
                </div>
            </x-form>

            <x-form action="{{ route('admin.films.genres.store') }}" class="m-0">
                <input name="search" id="searchHidden" type="text" hidden readonly> 

                <x-button type="submit" class="btn-success">
                    {{ __('Создать') }}
                </x-button>
            </x-form>
        </div>

        <x-error name="search" />
    </div>
    

    @if ($genres->isEmpty())
        {{ __('Нет ни одного жанра') }}
    @else
        <ul class="list-group mb-3">
            @foreach ($genres as $genre)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ Illuminate\Support\Str::of($genre->name)->ucfirst() }}
                    </span>

                    <span class="text-danger" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#confirmationModal_deleteGenre{{ $genre->id }}">
                        {{ __('Удалить') }}
                    </span>

                    <x-modal method="DELETE"
                            action="{{ route('admin.films.genres.delete', $genre->id) }}" 
                            id="confirmationModal_deleteGenre{{ $genre->id }}"
                            button-text="Удалить">
                            
                        <div class="text-danger mb-2">
                            <span class="fw-bold">{{ __('ВНИМАНИЕ: ') }}</span>{{ __('будут удалены все фильмы с этим жанром, а также статьи по этим фильмам') }}
                        </div>
                        <div>
                            {{ __("Вы действительно хотите удалить жанр \"{$genre->name}\"?") }}
                        </div>
                    </x-modal>
                </li>
            @endforeach
        </ul>

        {{ $genres->links() }}
    @endif
@endsection

<script>
    window.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById("search").addEventListener("change", function() {
            let searchInput = document.getElementById("search");
            let createInput = document.getElementById("searchHidden");

            createInput.value = searchInput.value;
        });
    });
</script>