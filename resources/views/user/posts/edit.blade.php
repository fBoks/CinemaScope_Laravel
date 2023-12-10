@extends('layouts.main')

@section('page.title', 'Изменить статью')

@section('main.content')
    
    <x-title>
        {{ __('Изменить статью') }}

        <x-slot name="link">
            <a href="{{ route('user.posts.show', $post->id) }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>
    
    <x-post.form action="{{ route('user.posts.update', $post->id) }}" method="PUT" :post="$post" :films="$films" :categories="$categories">
        <x-button type="submit">
            {{ __('Сохранить') }}
        </x-button>
    </x-post.form>
@endsection

