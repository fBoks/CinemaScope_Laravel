@extends('layouts.main')

@section('page.title', __('Работник - создать'))

@section('main.content')

    <x-title>
        {{ __('Работник - создать') }}

        <x-slot name="link">
            <x-back-link href="{{ route('admin.panel') }}"/>
        </x-slot>
    </x-title>

    <x-form action="{{ route('admin.films.workers.store') }}" method="POST">
        <x-form-item>
            <x-input-floating-label name="surname" id="floatingName" value="{{ old('surname') }}" type="text" placeholder="{{ __('Фамилия') }}">
                {{ __('Фамилия') }}
            </x-input-floating-label>

            <x-error name="surname" />
        </x-form-item>

        <x-form-item>
            <x-input-floating-label name="first_name" id="floatingFirstName" value="{{ old('first_name') }}" type="text" placeholder="{{ __('Имя') }}">
                {{ __('Имя') }}
            </x-input-floating-label>

            <x-error name="first_name" /> 
        </x-form-item>

        <x-form-item>
            <x-label>{{ __('Роли') }}</x-label>
            <select class="form-select" name="roles[]" id="roles" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </x-form-item>

        <x-button type="submit" >
            {{ __('Создать') }}
        </x-button>
    </x-form>
@endsection

@once
    @push('js')
        <script type="text/javascript" src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    @endpush
@endonce