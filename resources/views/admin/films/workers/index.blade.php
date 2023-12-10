@extends('layouts.main')

@section('page.title', 'Админ - работники кино')

@section('main.content')
    
    <x-title>
        {{ __('Админ - работники кино') }}

        <x-slot name="link">
            <x-back-link href="{{ route('admin.panel') }}"/>
        </x-slot>

        <x-slot name="right">
            <x-button-link href="{{ route('admin.films.workers.create') }}">
                {{ __('Создать') }}
            </x-button-link>
        </x-slot>
    </x-title>

    @include('admin.films.workers.filter')

    @if ($workers->isEmpty())
        {{ __('Нет ни одного работника') }}
    @else
        <div class="row">
            @foreach ($workers as $worker)
                <div class="col-12">
                    <x-film.worker.card :worker="$worker"/>
                </div>
            @endforeach
        </div>

        {{ $workers->links() }}
    @endif
@endsection