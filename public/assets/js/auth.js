document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem('token');
    const bodyContent = document.querySelector('body');
    const currentPath = window.location.pathname;
    const publicPaths = ['/', '/login', '/forgot-password', '/reset-password'];

    if (bodyContent) {
        bodyContent.style.display = 'none';
    }

    if (!publicPaths.includes(currentPath)) {
        // Halaman butuh login
        if (!token) {
            window.location.href = '/';
        } else {
            bodyContent.style.display = 'block';
        }
    } else {
        // Halaman publik
        bodyContent.style.display = 'block';
    }
});





// log Out button
function logout() {
    fetch('/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            // CSRF token dari cookie Laravel
            'X-XSRF-TOKEN': getCookie('XSRF-TOKEN'),
        },
        credentials: 'include' 
    })
    .then(response => {
        localStorage.removeItem('token');
        document.cookie = 'laravel_session=; Max-Age=0; path=/';
        document.cookie = 'XSRF-TOKEN=; Max-Age=0; path=/';

        window.location.href = '/';
    });
}

function getCookie(name) {
    let cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}

