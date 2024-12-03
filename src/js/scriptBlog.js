document.addEventListener('DOMContentLoaded', function() {
    const readMoreButtons = document.querySelectorAll('.read-more');

    readMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const content = this.parentElement.querySelector('.more-content');
            if (content.style.display === 'none' || content.style.display === '') {
                content.style.display = 'block';
                this.textContent = 'LEER MENOS';
            } else {
                content.style.display = 'none';
                this.textContent = 'LEER MÁS';
            }
        });
    });
});
