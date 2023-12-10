@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')
    
    <div class="mb-4">
        <x-title>
            <x-slot name="link">
                <x-back-link href="{{ route('blog') }}" />
            </x-slot>

            @auth
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
            @endauth

            <h2 class="h4 col-md-12 col-sm-12 mb-1">
                <div class="row">
                    <div class="col-md-12 col-sm-8 mb-1">
                        {{ __($post->title) }}
                    </div>

                    <div class="col-md-12 col-sm-4 text-secondary fw-normal fs-6">
                        {{ __($post->category) }}
                    </div>
                </div>
            </h2>
        </x-title>

        <a href="{{ route('films.show', $post->film_id) }}" class="col-md-4 col-sm-12">
            {{ __($post->film) }}
        </a>

        <div class="pt-2 mb-2">
            {!! __($post->content) !!}
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <div class="text-muted">
                {{ $post->user }}
            </div>
        
            <div class="small text-muted">
                {{ $post->published_at?->diffForHumans() }}
            </div>
        </div>
    </div>

    <div>
        <div class="d-flex justify-content-between">
            <h5 class="mb-3">{{ __('Комментарии') }}</h5>

            @auth
                <div class="mb-3">
                    <x-button-link href="{{ route('user.posts.comments.create', $post->id) }}">
                        {{ __('Написать') }}
                    </x-button-link>
                </div>
            @endauth
        </div>

        <div>
            @foreach ($comments as $comment)
                <a href="{{ route('user.posts.comments.show', ['post' => $post->id, 'comment' => $comment->id]) }}" class="text-decoration-none">
                    <div class="mb-2 card p-2 hover-overlay">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div class="mb-1 fw-normal">
                                {{ $comment->user }}
                            </div>

                            <div class="small text-muted">
                                {{ $comment->commented_at->diffForHumans() }}
                            </div>
                        </div>
                        
                        <div class="">
                            {!! $comment->text !!}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $comments->links() }}
    </div>
@endsection