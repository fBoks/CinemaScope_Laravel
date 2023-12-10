@extends('layouts.main')

@section('page.title', 'Просмотр статьи')

@section('main.content')
    
    <x-title>
        {{ __('Просмотр статьи') }}

        <x-slot name="link">
            <a href="{{ route('user.posts') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>

        @if (Auth::id() == $post->user_id 
            || Auth::user()->role_id == 'admin'
            || Auth::user()->role_id == 'moderator')
            
            <x-slot name="right">
                @if (Auth::id() == $post->user_id)
                    <x-button-link href="{{ route('user.posts.edit', $post->id) }}">
                        {{ __('Изменить') }}
                    </x-button-link>
                @endif

                <x-button type="button" class="bg-danger border-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal_deletePost{{ $post->id }}">
                    {{ __('Удалить') }}
                </x-button>

                <x-modal method="DELETE"
                        action="{{ route('user.posts.delete', $post->id) }}" 
                        id="confirmationModal_deletePost{{ $post->id }}"
                        button-text="Удалить">

                    <div>
                        {{ __('Вы действительно хотите удалить статью?') }}
                    </div>
                </x-modal>
            </x-slot>
        @endif
    </x-title>

    <div class="mb-5">
        <div class="row mb-md-1 mb-sm-5">
            <h2 class="h4 col-md-8 col-sm-12 mb-md-2 mb-sm-5">
                <div class="row">
                    <div class="col-md-12 col-sm-8 mb-1">
                        {{ $post->title }}
                    </div>

                    <div class="col-md-12 col-sm-4 text-secondary fw-normal fs-6">
                        {{ $post->category }}
                    </div>
                </div>
            </h2>

            <div class="col-md-4 col-sm-12 d-flex flex-column">
                <div class="d-flex justify-content-between small text-muted">
                    <span>Создано:</span>
                    <span>{{ $post->created_at?->diffForHumans() }}</span>
                </div>

                <div class="d-flex justify-content-between small text-muted">
                    <span>Изменено:</span>
                    <span>{{ $post->updated_at?->diffForHumans() }}</span>
                </div>

                @if ($post->published_at)
                    <div class="d-flex justify-content-between small text-muted">
                        <span>Опубликовано:</span>
                        <span>{{ $post->published_at?->diffForHumans() }}</span>
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ route('films.show', $post->film_id) }}" class="col-md-4 col-sm-12">
            {{ $post->film }}
        </a>

        <div class="pt-3">
            {!! $post->content !!}
        </div>
    </div>

@endsection