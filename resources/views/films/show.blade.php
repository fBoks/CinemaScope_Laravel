@extends('layouts.main')

@section('page.title', $film->name)

@section('main.content')
    
    <x-title class="d-flex align-items-center">
        <x-slot name="link">
            <x-back-link href="{{ route('films') }}"/>
        </x-slot>
        
        {{ __($film->name) }}

        <div class="mt-n1 mb-3">
            <span class="text-secondary fw-normal fs-5">
                {{ $film->tagline }}
            </span>
        </div>

        <div class="text-secondary fw-normal fs-6">
            @foreach ($film->genres as $genre)
                <span class="text-secondary fs-6 me-2">
                    {{ $genre->name }}
                </span>
            @endforeach
        </div>

        @auth
            @if (Auth::user()->role_id == 'admin')
                <x-slot name="right">
                    <x-button-link href="{{ route('admin.films.edit', $film->id) }}">
                        {{ __('Изменить') }}
                    </x-button-link>
                    
                    <x-button type="button" class="bg-danger border-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal_deleteFilm{{ $film->id }}">
                        {{ __('Удалить') }}
                    </x-button>

                    <x-modal method="DELETE"
                            action="{{ route('admin.films.delete', $film->id) }}" 
                            id="confirmationModal_deleteFilm{{ $film->id }}"
                            button-text="Удалить">
                                
                        <div class="text-danger mb-2">
                            <span class="fw-bold">{{ __('ВНИМАНИЕ: ') }}</span>{{ __('будут удалены все статьи с этим фильмом') }}
                        </div>
                        <div>
                            {{ __('Вы действительно хотите удалить фильм?') }}
                        </div>
                    </x-modal>
                </x-slot>
            @endif
        @endauth
    </x-title>

    <div class="mb-5">
        <div class="border-bottom">
            <div class="row row-cols-md-3 mb-md-1 mb-sm-5 pb-3">
                <div class="col col-12 d-flex flex-column">
                    <div class="d-flex justify-content-between small text-secondary mb-2">
                        <span>Режиссер:</span>
                        <div class="d-flex flex-column align-items-end">
                            @foreach ($film->creators['directors'] as $director)
                                <span class="text-end">{{ $director->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between small text-secondary mb-2">
                        <span>Сценарист:</span>
                        <div class="d-flex flex-column align-items-end">
                            @foreach ($film->creators['screenwriters'] as $screenwriter)
                                <span class="text-end">{{ $screenwriter->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between small text-secondary mb-2">
                        <span>Продюсер:</span>
                        <div class="d-flex flex-column align-items-end">
                            @foreach ($film->creators['producers'] as $producer)
                                <span class="text-end">{{ $producer->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col col-12 d-flex justify-content-between mb-2 text-secondary small">
                    <span>Актеры:</span>
                    <div class="d-flex flex-column">
                        @foreach ($film->actors as $actor)
                            <span class="text-end">
                                {{ $actor->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="col col-sm-12">
                    <div class="d-flex gap-2 justify-content-md-end small text-secondary">
                        <span class="text-end">Год выпуска:</span>
                        <span class="text-end">{{ $film->realised_at->format('Y') }} г.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="pt-3">
                {!! $film->description !!}
            </div>
        </div>
    </div>

@endsection