document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});

// document.getElementById('loginForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     const email = document.getElementById('email').value;
//     const password = document.getElementById('password').value;

//     fetch('http://yourdomain.com/index.php?action=login', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ email: email, password: password })
//     })
//     .then(response => response.json())
//     .then(data => {
//         alert(data);
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });
