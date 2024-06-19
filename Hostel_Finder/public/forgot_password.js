document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;

    fetch('http://yourdomain.com/index.php?action=forgot-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
