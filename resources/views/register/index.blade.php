@extends('layouts.auth')

@section('page.title', 'Регистрация')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Регистрация') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('login') }}" class="text-secondary">
                    {{ __('Вход') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            <x-form action="{{ route('register.store') }}" method="POST">                    
                <x-form-item>
                    <x-label required>{{ __('Логин') }}</x-label>
                    <x-input type="text" name="login" value="{{ old('login') }}" autofocus />

                    <x-error name='login' />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Email') }}</x-label>
                    <x-input type="email" name="email" value="{{ old('email') }}" autofocus />

                    <x-error name='email' />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Пароль') }}</x-label>
                    <x-input type="password" name="password" />

                    <x-error name='password' />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Подтверждение пароля') }}</x-label>
                    <x-input type="password" name="password_confirmation" />

                    <x-error name='password_confirmation' />
                </x-form-item>

                <x-button type="submit" >
                    {{ __('Создать аккаунт') }}
                </x-button>
            </x-form>
        </x-card-body>
    </x-card>
@endsection