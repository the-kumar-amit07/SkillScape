
const themeSwitch = document.getElementById('themeSwitch');
const toggleText = themeSwitch.querySelector('span');
const body = document.body;

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
        toggleText.textContent = 'light_mode';
    } else {
        body.classList.add('light-mode');
        toggleText.textContent = 'dark_mode';
    }
    

    themeSwitch.addEventListener('click',function () {
        body.classList.toggle('dark-mode');
        body.classList.toggle('light-mode');

        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
            toggleText.textContent = 'light_mode';
        } else { 
            localStorage.setItem('dark-mode', 'disabled');
            toggleText.textContent = 'dark_mode';
        }
    })

