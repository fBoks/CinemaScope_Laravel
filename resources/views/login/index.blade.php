@extends('layouts.auth')

@section('page.title', 'Вход')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Вход') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('register') }}" class="text-secondary">
                    {{ __('Регистрация') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            <x-form action="{{ route('login.store') }}" method="POST">
                <x-form-item>
                    <x-label required>{{ __('Логин') }}</x-label>
                    <x-input type="text" name="login" value="{{ old('login') }}" autofocus />

                    <x-error name="login" />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Пароль') }}</x-label>
                    <x-input type="password" name="password" />

                    <x-error name="password" /> 
                </x-form-item>

                <x-form-item>
                    <x-checkbox name="remember" value="1">
                        {{ __('Запомнить меня') }}
                    </x-checkbox>
                </x-form-item>

                <x-button type="submit" >
                    {{ __('Войти') }}
                </x-button>
            </x-form>
        </x-card-body>
    </x-card>
@endsection