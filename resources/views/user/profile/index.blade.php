@extends('layouts.main')

@section('page.title', __('Профиль'))

@section('main.content')
    
    <x-title>
        {{ __('Профиль') }}
    </x-title>

    <x-form href="{{ route('user.profile.update', $user->id) }}" method="PUT">
        <div class="row mb-2">
            <div class="col-md-6 col-12">
                <x-label>{{ __('Логин') }}</x-label>
                <x-input name="login" value="{{ $user->login }}" disabled />
            </div>

            <div class="col-md-6 col-12">
                <x-label>{{ __('Email') }}</x-label>
                <x-input name="email" value="{{ $user->email }}" />

                <x-error name="email" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-12">
                <x-label required>{{ __('Пароль') }}</x-label>
                <x-input name="password" type="password"/>

                <x-error name="password" />
            </div>

            <div class="col-md-6 col-12">
                <x-label>{{ __('Новый пароль') }}</x-label>
                <x-input name="password_new" type="password" />

                <x-error name="password_new" />
            </div>
        </div>

        <x-button type="submit">
            {{ __('Сохранить') }}
        </x-button>
    </x-form>
    
@endsection