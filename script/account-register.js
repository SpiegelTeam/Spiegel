const signupButton = document.querySelector('#signup');
const modalBg = document.querySelector('.modal-background');
const modal = document.querySelector('.modal');
const modalContent = document.querySelector('.modal-content');

signupButton.addEventListener('click', () => {
    modal.classList.add('is-active')
})

modalBg.addEventListener('click', () => {
    modal.classList.remove('is-active')
})

if (modalContent) {
    modalContent.addEventListener('click', (event) => {
        event.stopPropagation();
    })
}