@extends('layouts.main')

@section('page.title', 'Админ - страны')

@section('main.content')
    
    <x-title>
        {{ __('Админ - страны') }}

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

            <x-form action="{{ route('admin.countries.store') }}" class="m-0">
                <input name="search" id="searchHidden" type="text" hidden readonly> 

                <x-button type="submit" class="btn-success">
                    {{ __('Создать') }}
                </x-button>
            </x-form>
        </div>

        <x-error name="search" />
    </div>
    

    @if ($countries->isEmpty())
        {{ __('Нет ни одной страны') }}
    @else
        <ul class="list-group mb-3">
            @foreach ($countries as $country)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ Illuminate\Support\Str::of($country->name)->ucfirst() }}
                    </span>

                    <span class="text-danger" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#confirmationModal_deleteCountry{{ $country->id }}">
                        {{ __('Удалить') }}
                    </span>

                    <x-modal method="DELETE"
                            action="{{ route('admin.countries.delete', $country->id) }}" 
                            id="confirmationModal_deleteCountry{{ $country->id }}"
                            button-text="Удалить">
                            
                        <div class="text-danger mb-2">
                            <span class="fw-bold">{{ __('ВНИМАНИЕ: ') }}</span>{{ __('будут удалены все фильмы с этой страной') }}
                        </div>
                        <div>
                            {{ __("Вы действительно хотите удалить страну \"{$country->name}\"?") }}
                        </div>
                    </x-modal>
                </li>
            @endforeach
        </ul>

        {{ $countries->links() }}
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