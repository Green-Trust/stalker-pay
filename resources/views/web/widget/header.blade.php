<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky" style="background: #000; padding-bottom: 10px;">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('web_index') }}"><img src="/assets/img/logo/1.png" alt="" style="width: 300px; margin-top: 10px; border-radius: 10px; box-shadow: 4px 4px 8px 0 rgba(34, 60, 80, 0.2);"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('web_index') }}" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Главная</a></li>
                                            <li><a href="#" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Поддержка</a></li>
                                            <li><a href="#" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Правила</a></li>
                                            <!-- Button -->
                                            <li class="button-header margin-left " style="font-family: 'Comfortaa', cursive; font-weight: bold;"><a href="{{ route('web_login') }}" class="btn" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Вход</a></li>
                                            <li class="button-header"><a href="{{ route('web_registration') }}" class="btn3" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Регистрация</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>