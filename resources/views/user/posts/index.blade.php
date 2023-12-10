@extends('layouts.main')

@section('page.title', 'Мои статьи')

@section('main.content')
    
    <x-title>
        {{ __('Мои статьи') }}

        <x-slot name="right">
            <x-button-link href="{{ route('user.posts.create') }}">
                {{ __('Создать') }}
            </x-button-link>
        </x-slot>
    </x-title>

    @if ($posts->isEmpty())
        {{ __('У вас нет статей') }}
    @else
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-12">
                    <x-post.card :post="$post" routePath='user.posts.show'/>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    @endif
    
@endsection