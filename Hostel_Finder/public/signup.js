document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('signupForm');
    const password = document.getElementById('password');
    const confirmPassword = document.querySelector('input[placeholder="Confirm Password"]');

    form.addEventListener('submit', function (event) {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
            alert('Passwords do not match.');
        }
    });
});
