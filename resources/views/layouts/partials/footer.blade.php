<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <a href="{{ route('home') }}" class="logo-container">
                <span class="logo-letter">S</span>
                <img src="{{ asset('img/Vector.png') }}" alt="Иконка" class="logo-icon">
                <span class="logo-rest">undCrafted</span>
            </a>
        </div>
        <div class="footer-center">
            <a href="{{ route('typesTools') }}" class="footer-btn">Виды инструментов</a>
            <a href="{{ route('survey') }}" class="footer-btn">Подбор инструмента</a>
            <a href="{{ route('groups') }}" class="footer-btn">Музыкальные группы</a>
        </div>
        <div class="footer-right">
            <div class="social-block">
                <div class="social-title">Наши социальные сети</div>
                <div class="social-row">
                    <div class="social-circle"><img src="{{ asset('img/tg.png') }}" alt="Telegram"></div>
                    <span>Telegram</span>
                </div>
                <div class="social-row">
                    <div class="social-circle"><img src="{{ asset('img/vk.png') }}" alt="VK"></div>
                    <span>VK</span>
                </div>
                <div class="social-row">
                    <div class="social-circle"><img src="{{ asset('img/youtube.png') }}" alt="YouTube"></div>
                    <span>YouTube</span>
                </div>
            </div>
            <div class="mail-block">
                <div class="mail-title">Наша почта</div>
                <div class="mail-text">SoundCrafted@gmail.com</div>
            </div>
        </div>
    </div>
    <p class="footer-bottom">© Все права защищены</p>
</footer>