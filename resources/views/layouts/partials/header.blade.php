<header class="header">
    <div class="container">
        <a href="{{ route('home') }}" class="logo-container">
            <span class="logo-letter">S</span>
            <img src="{{ asset('img/Vector.png') }}" alt="Иконка" class="logo-icon">
            <span class="logo-rest">undCrafted</span>
        </a>
        <div class="menu-nav">
            <ul>
                <li><a href="{{ route('typesTools') }}">Виды инструментов</a></li>
                <li><a href="{{ route('survey') }}">Подбор инструмента</a></li>
                <li><a href="{{ route('groups') }}">Музыкальные группы</a></li>
                <li>
                    @auth
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <a href="{{ route('favourites') }}" class="menu-fav">
                                <img src="{{ asset('img/user.png') }}" alt="Профиль">
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: #FFA600; border: none; padding: 0.5em 1em; border-radius: 5px; cursor: pointer; font-family: 'Binggrae'; font-size: 1em;">Выйти</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="menu-fav">
                            <img src="{{ asset('img/user.png') }}" alt="Профиль">
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</header>