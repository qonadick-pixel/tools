
    <div class="app-bar">
        <div class="logo">
            <div class="logo-txt"><a href="/">Grand Tools</a></div>
        </div>
        <div class="menu">
            <div class="menu-main"><a href="/" class="link__main link__header">Главная</a></div>
            <div class="menu-errors"><a href="/errors" class="link__errors link__header">Решение ошибок</a></div>
            <div class="menu-howtouse"><a href="/install" class="link__install link__header">Как установить?</a></div>
        </div>
        <div class="autorization">
            <?php     
            if(!$user || $_SESSION['auth'] == false)
            {
                echo '<button class="btn__one" onclick="location.href=`login`">Авторизация</button>'; 
            } else {
                echo '<button class="btn__one" onclick="location.href=`profile`">Панель управления</button>'; 
            }
            ?>
        </div>
    </div>    