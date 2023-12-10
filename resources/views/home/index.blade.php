@extends('layouts.main')

@section('main.content')
    <div class="text-center mb-4">
        <h1>
            {{ __('Cinemascope') }}
            <br>
            <div class="h2">
                {{ __('Пересказы и обзоры фильмов') }}
            </div>
        </h1>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="">
            <h3 class="mb-xs-5 mb-md-3">{{ __('О блоге') }}</h3>
            <p class="text-break">
                {{ __('Блог представляет собой платформу для обмена мнениями о фильмах. После регистрации вы можете опубликовать обзор или пересказ своего любимого фильма, поделившись впечатлениями и мыслями с другими читателями. Кроме того, в блоге представлена информация о фильмах: название, описание, а также возможность сортировки по названию, жанру и году выпуска. Это обеспечит вам удобство при поиске интересующих вас фильмов.') }}
            </p>
        </div>

        <div class="">
            <div class="d-flex justify-content-between align-items-md-center align-items-baseline mb-3">
                <h3 class="">{{ __('Недавно добавленные фильмы') }}</h3>
                <h5><a href="{{ route('films') }}" class="text-decoration-none">Все</a></h5>
            </div>

            @if ($films->isEmpty())
                {{ __('Нет ни одного фильма') }}
            @else
                <div class="row">
                    @foreach ($films as $film)
                        <div class="col-12">
                            <x-film.card :film="$film" class="hover-overlay" routePath='films.show'/>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="">{{ __('Последние статьи') }}</h3>
                <h5><a href="{{ route('blog') }}" class="text-decoration-none">Все</a></h5>
            </div>

            @if ($posts->isEmpty())
                {{ __('Нет ни одной статьи') }}
            @else
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-12">
                            <x-post.card :post="$post" class="hover-overlay" routePath='blog.show'/>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- <x-form action="{{ route('user.posts.store') }}" method="POST">
            <select class="form-select" name="cars[]" id="cars" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                <option value="1">Abarth</option>
                <option value="2">Alfa Romeo</option>
                <option value="3">Aston Martin</option>
                <option value="4">Audi</option>
                <option value="5">Bentley</option>
                <option value="6">BMW</option>
            </select>

            <div class="col-md-12 col-sm-12">
                <div class="mb-4">
                    <x-button type="submit" class="w-100">
                        {{ __('Найти') }}
                    </x-button>
                </div>
            </div>
        </x-form> --}}
    </div>
@endsection
