@extends('layouts.main')

@section('page.title', __('Работник - редактировать'))

@section('main.content')

    <x-title>
        {{ __('Работник - редактировать') }}

        <x-slot name="link">
            <x-back-link href="{{ url()->previous() }}"/>
        </x-slot>
    </x-title>

    <x-form action="{{ route('admin.films.workers.update', $worker->id) }}" method="PUT">
        <x-form-item>
            <x-input-floating-label name="surname" id="floatingName" value="{{ $worker->surname }}" type="text" placeholder="{{ __('Фамилия') }}">
                {{ __('Фамилия') }}
            </x-input-floating-label>

            <x-error name="surname" />
        </x-form-item>

        <x-form-item>
            <x-input-floating-label name="first_name" id="floatingFirstName" value="{{ $worker->first_name }}" type="text" placeholder="{{ __('Имя') }}">
                {{ __('Имя') }}
            </x-input-floating-label>

            <x-error name="first_name" /> 
        </x-form-item>
        
        <x-form-item>
            <x-label>{{ __('Роли') }}</x-label>
            <select class="form-select w-100 m-0" name="roles[]" id="roles" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="2">
                @foreach ($roles as $role)

                    {{ $selected = null}}
                    @foreach ($selected_roles as $selected_role)
                        @if ($role->id == $selected_role->cinema_i_role_id)
                            {{$selected = 'selected'}}
                            @break
                        @endif
                    @endforeach

                    <option {{ $selected }} value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <x-error name="roles" /> 
        </x-form-item>

        <div class="d-flex justify-content-between">
            <x-button type="submit" >
                {{ __('Сохранить') }}
            </x-button>

            <x-button type="button" class="btn-danger m-0" data-bs-toggle="modal" data-bs-target="#confirmationModal_deleteWorker{{ $worker->id }}">
                {{ __('Удалить') }}
            </x-button>
        </div>
    </x-form>

    <x-modal method="DELETE"
            action="{{ route('admin.films.workers.delete', $worker->id) }}" 
            id="confirmationModal_deleteWorker{{ $worker->id }}"
            button-text="Удалить">
                
        <div class="text-danger mb-2">
            <span class="fw-bold">{{ __('ВНИМАНИЕ: ') }}</span>{{ __('будут удалены все фильмы с этим работником, а так же статьи с этими фильмами') }}
        </div>
        <div>
            {{ __('Вы действительно хотите удалить работника?') }}
        </div>
    </x-modal>
@endsection

@once
    @push('js')
        <script type="text/javascript" src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    @endpush
@endonce