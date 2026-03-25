const signupButton = document.querySelector('#signup');
const modalBg = document.querySelector('.exit-modal');
const modal = document.querySelector('.modal');

signupButton.addEventListener('click', () => {
    modal.classList.add('is-active')
})

modalBg.addEventListener('click', () => {
    modal.classList.remove('is-active')
})