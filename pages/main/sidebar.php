        <script src="https://kit.fontawesome.com/60ffe1824d.js" crossorigin="anonymous"></script>
        <div id="app" class="app">
            <div class="app-nav" style="border-bottom: 2px solid #282633;">
                <nav >
                    
                    <div class="navbar-brand logo" style="margin-left: 25px;">
                        <div class="app-nav-logo">
                            <a href="/" class="app_nav__logo">Grand Tools</a> <span class="text-muted"><?php echo $title ?></span>
                        </div>
                    </div>

                    <div class="collapse" id="navbarSupportedContent">

                        <!-- Right Side Of Navbar -->
                        <div class="connections">
                                <div class="telegram">
                                    <a href="https://t.me/grndtools"  class="conn__icon" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                                </div>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item d-flex align-items-center me-2"><?php 
                                if($user['status'] == 'user') {
                                    echo '<span class="badge badge-secondary">Пользователь</span>';
                                } else if($user['status'] == 'admin') {
                                    echo '<span class="badge badge-secondary" style="background: #73b461;">Администратор</span>';
                                } else if($user['status'] == 'dev') {
                                    echo '<span class="badge badge-secondary" style="background: #be2d2d;">Разработчик</span>';
                                /*} else if($user['status'] == 'support') {
                                    echo '<span class="badge badge-secondary" style="background: #80BFFF;">Поддержка</span>';*/
                                }
                                ?>
                            </li>

                            

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link usr-logo-nav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre="">
                                    
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="profile" class="dropdown-item" style="display: flex; padding: 5px !important; padding-left: 15px !important; border-bottom: 2px solid #282633;">
                                        <p class="usr-logo-nav"></p>
                                        <span style="font-size: 17px; display: flex; justify-content: center; align-items: center; padding-left: 10px">
                                            <?php echo $user['name'] ?>
                                        </span>
                                    </a>
                                    <a class="dropdown-item" id="logout" type="logout" value="logout" style="cursor: pointer;">
                                        Выйти из системы
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            
            <div class="app-sidebar bg-dark">
                <div class="d-flex flex-column flex-shrink-0">  
                    <div class="themme">
                        <i class="change-theme" data-theme="close" style="color: #fff;" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-sidebar-right-expand-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 3a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h12zm-3 2h-9a1 1 0 0 0 -.993 .883l-.007 .117v12a1 1 0 0 0 .883 .993l.117 .007h9v-14zm-3.293 4.293a1 1 0 0 1 .083 1.32l-.083 .094l-1.292 1.293l1.292 1.293a1 1 0 0 1 .083 1.32l-.083 .094a1 1 0 0 1 -1.32 .083l-.094 -.083l-2 -2a1 1 0 0 1 -.083 -1.32l.083 -.094l2 -2a1 1 0 0 1 1.414 0z" stroke-width="0" fill="currentColor" /></svg>
                        </i>
                        <i class="change-theme" data-theme="open" style="color: #fff;" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-sidebar-left-expand-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 3a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h12zm0 2h-9v14h9a1 1 0 0 0 .993 -.883l.007 -.117v-12a1 1 0 0 0 -.883 -.993l-.117 -.007zm-4.387 4.21l.094 .083l2 2a1 1 0 0 1 .083 1.32l-.083 .094l-2 2a1 1 0 0 1 -1.497 -1.32l.083 -.094l1.292 -1.293l-1.292 -1.293a1 1 0 0 1 -.083 -1.32l.083 -.094a1 1 0 0 1 1.32 -.083z" stroke-width="0" fill="currentColor" /></svg>
                        </i>
                    </div>             
                    <div class="app-nav-menu">
                        <div class="app-nav -menu__item">
                            <div class="app-nav-menu__item-link app-nav-menu__item-link--active popup-link menu__profile" style="cursor: pointer; display: flex; justify-content: center; align-items: center; background: none">
                                <img src="/assets/img/chudo.png" alt="" style="width: 64px; height: 64px">
                            </div>
                            <a onclick="openModalAuth()" class="app-nav-menu__item-link app-nav-menu__item-link--active popup-link" style="cursor: pointer">
                                <i class="fa fa-diamond"></i>
                                Авторизация в скрипт
                            </a>

                            <a class="app-nav-menu__item-link app-nav-menu__item-link--active profile-block-active" href="profile">
                                <i class="fa-solid fa-user"></i>
                                Мой профиль
                            </a>
                            
                            <?php
                            if($user['status'] == 'admin' || $user['status'] == 'dev' || $user['status'] == 'support') {
                                echo '
                                <a class="app-nav-menu__item-link app-nav-menu__item-link--active statistic-block-active" href="stats">
                                    <i class="fa-solid fa-chart-simple"></i>
                                    Статистика
                                </a>
                            
                                <a class="app-nav-menu__item-link app-nav-menu__item-link--active keys-block-active" href="keys">
                                    <i class="fa fa-key"></i>
                                    Ключи
                                </a>

                                <li style="list-style-type: none;">
                                    <a class="app-nav-menu__item-link app-nav-menu__item-link--active users-block-active" href="#" data-bs-toggle="dropdown">
                                        <i class="fa fa-users" aria-hidden="true"></i>Пользователи
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item users-dropdown" href="siteusers">
                                            Пользователи сайта
                                        </a>

                                        <a class="dropdown-item users-dropdown" href="keyusers">
                                            Пользователи скрипта
                                        </a>
                                    </div>
                                </li>

                                <li style="list-style-type: none;">
                                    <a class="app-nav-menu__item-link app-nav-menu__item-link--active requests-block-active" href="#" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-comment-dots"></i>Запросы на сброс
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item users-dropdown" href="hwidrequests">
                                            Запросы на сброс HWID ключа
                                        </a>
                                    </div>
                                </li>

                                <a class="app-nav-menu__item-link app-nav-menu__item-link--active logs-block-active" href="logs">
                                    <i class="fa fa-home"></i>
                                    Логи
                                </a>
                                
                                <a class="app-nav-menu__item-link app-nav-menu__item-link--active bot-block-active" href="bot">
                                    <i class="fa fa-computer"></i>
                                    Бот
                                </a>'; 
                            }
                            ?>
                            <a class="app-nav-menu__item-link app-nav-menu__item-link--active settings-block-active" href="settings">
                                <i class="fa fa-cog"></i>
                                Настройки
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .themme {
                position: absolute;
                top: 15%;
                right: -20%;
                font-size: 20px;
            }
        </style>
        <script>
        function play() {
            var snd = new Audio("/assets/sound/notify.mp3");
            snd.play()
            snd.currentTime=0
        }
        </script>