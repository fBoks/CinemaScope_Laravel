@extends('layouts.main')

@section('page.title', __($post->title))

@section('main.content')

    <x-title>
        {{ __($post->title) }}

        <x-slot name="link">
            <x-back-link href="{{ url()->previous() }}"/>
        </x-slot>

        <x-slot name="right">
            @if (Auth::id() == $comment->user_id
                || Auth::user()->role_id == 'admin'
                || Auth::user()->role_id == 'moderator')
                
                <x-button type="button" class="bg-danger border-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal_deleteComment{{ $comment->id }}">
                    {{ __('Удалить') }}
                </x-button>

                <x-modal method="DELETE"
                        action="{{ route('user.posts.comments.delete', [$post->id, $comment->id]) }}" 
                        id="confirmationModal_deleteComment{{ $comment->id }}"
                        button-text="Удалить">
                        
                    <div>
                        {{ __('Вы действительно хотите удалить комментарий?') }}
                    </div>
                </x-modal>
            @endif
        </x-slot>
    </x-title>

    <div class="col-md-col-12 col-12 mb-md-0 mb-3">
        <h5 class="mb-3">{{ __('Комментарий') }}</h5>

        <div class="mb-2">
            {!! $comment->text !!}
        </div>

        <div class="d-flex justify-content-between align-items-baseline text-muted">
            <span>{{ $comment->login }}</span>
            <span>{{ $comment->commented_at->diffForHumans() }}</span>
        </div>
    </div>
@endsection