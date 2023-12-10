@extends('layouts.main')

@section('page.title', 'Создать статью')

@section('main.content')
    
    <x-title>
        {{ __('Создать статью')}}

        <x-slot name="link">
            <a href="{{ route('user.posts') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>

    <x-post.form action="{{ route('user.posts.store') }}" method="POST" :films="$films" :categories="$categories">
        <x-button type="submit">
            {{ __('Создать') }}
        </x-button>
    </x-post.form>
@endsection

