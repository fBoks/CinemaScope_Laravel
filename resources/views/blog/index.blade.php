@extends('layouts.main')

@section('page.title', 'Статьи')

@section('main.content')
    
    <x-title>
        {{ __('Список статей') }}

        @auth
            <x-slot name="right">
                <x-button-link href="{{ route('user.posts.create') }}">
                    {{ __('Создать') }}
                </x-button-link>
            </x-slot>
        @endauth
    </x-title>

    @include('blog.filter')

    @if ($posts->isEmpty())
        {{ __('Нет ни одной статьи') }}
    @else
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-12">
                    <x-post.card :post="$post" class="hover-overlay" routePath='blog.show'/>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    @endif
    
@endsection