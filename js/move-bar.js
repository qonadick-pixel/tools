$('.app-nav-menu-btn').on('click', function(e) {
    console.log('norm')
    e.preventDefault();
    $('.app-sidebar').toggleClass('app-sidebar_active');
    console.log('bad')
})