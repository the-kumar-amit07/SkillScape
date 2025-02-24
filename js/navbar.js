    document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.querySelector('.sidebar');
    const menu_btn = document.querySelector('#menu_btn');
    const close_sidebar = document.querySelector('#close_sidebar');
    const user_btn = document.querySelector('#user_btn');
    const profile = document.querySelector('.profile');
    const close_toggle = document.querySelector('#close_toggle')


    // Profile Toggle Button
    user_btn.addEventListener('click', () => {
        profile.classList.toggle('active');
    });


    // Sidebar Toggle Button 
    menu_btn.addEventListener("click", function () {
        sidebar.classList.add('active');
    });

    close_sidebar.addEventListener('click', function () {
        sidebar.classList.remove('active');
    });
});