const themeSwitchers = document.querySelectorAll('.change-theme');

    themeSwitchers.forEach(switcher => {
        switcher.addEventListener('click', function() {
            applyTheme(this.dataset.theme);
            localStorage.setItem('theme', this.dataset.theme);
        });
    });

    function applyTheme(themeName) {
        let themeUrl = `css/menu/${themeName}.css`;
        document.querySelector('[title="menu"]').setAttribute('href', themeUrl);
    }

    let activeTheme = localStorage.getItem('theme');

    if (activeTheme === null) {
        applyTheme('open');
    } else {
        applyTheme(activeTheme);
    }