const signUpButton = document.getElementById('register');
const signInButton = document.getElementById('login');
const container = document.getElementById('container');

// function handleErrorMessages() {
//     const errorMessage = document.querySelector('.error-message');
//     if (errorMessage && errorMessage.textContent.includes('Sign Up error')) {
//         container.classList.add('active');
//     } else {
//         container.classList.remove('active');
//     }
// }
//
// document.addEventListener('DOMContentLoaded', handleErrorMessages);

signInButton.addEventListener('click', () => {
    container.classList.remove('active');
});

signUpButton.addEventListener('click', () => {
    container.classList.add('active');
});
