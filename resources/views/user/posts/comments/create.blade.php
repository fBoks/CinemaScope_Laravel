@extends('layouts.main')

@section('page.title', __($post->title))

@section('main.content')

    <x-title>
        {{ __($post->title) }}

        <x-slot name="link">
            <x-back-link href="{{ url()->previous() }}"/>
        </x-slot>
    </x-title>

    <x-form action="{{ route('user.posts.comments.store', $post->id) }}" method="POST">
        <div class="col-md-col-12 col-12 mb-md-0 mb-3">
            <h5 class="mb-3">{{ __('Комментарий') }}</h5>

            <x-trix name="comment" />

            <x-error name="comment" />
        </div>

        <x-button type="submit" class="mt-2" >
            {{ __('Отправить') }}
        </x-button>
    </x-form>
@endsection