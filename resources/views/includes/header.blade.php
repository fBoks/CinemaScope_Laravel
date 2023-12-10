<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">
        {{ config('app.name') }}
    </a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0 text-center">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ active_link('home') }}">
                {{ __('Главная') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('blog') }}" class="nav-link {{ active_link('blog*') }}">
                {{ __('Статьи') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('films') }}" class="nav-link {{ active_link('films*') }}">
                {{ __('Фильмы') }}
            </a>
        </li>
      </ul>

      

      <ul class="navbar-nav ms-auto mb-2 mb-md-0 text-center">
        @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->login }}
              </a>
              <ul class="dropdown-menu col-sm-6">
                  <li><a class="dropdown-item" href="{{ route('user.profile', Auth::id()) }}">Профиль</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.posts') }}">Мои статьи</a></li>

                  @if (Auth::user()->role_id == 'admin')
                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="{{ route('admin.panel') }}">Панель</a></li>
                    {{-- <li><a class="dropdown-item" href="{{ route('admin.statistics') }}">Статистика</a></li> --}}

                  {{-- @elseif (Auth::user()->role_id == 'moderator')
                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="{{ route('moderator.panel') }}">Панель</a></li> --}}
                  @endif

                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти</a></li>
                </ul>
            </li>
        @endauth

        @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ active_link('login') }}">
                    {{ __('Вход') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link pe-0 {{ active_link('register') }}">
                    {{ __('Регистрация') }}
                </a>
            </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

@once
  @push('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
  @endpush
@endonce