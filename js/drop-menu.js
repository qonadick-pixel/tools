document.getElementById('nav-menu-users').onmouseover = function(event) {
    var target = event.target;
    if (target.className == 'menu-item') {
        var s = target.getElementsByClassName('submenu-users');
        closeMenu();
        s[0].style.display='block';
    }
}

document.onmouseover = function(event) {
    var target = event.target;
    console.log(event.target);
    if (target.className != "menu-item" && target.className != 'submenu-users') {
        closeMenu();
    }
}

function closeMenu() {
    var menu = document.getElementById('nav-menu-users');
    var subm = document.getElementsByClassName('submenu-users');
    for (var i=0; i <subm.length; i++) {
        subm[i].style.display="none";
    }
}