document.addEventListener('DOMContentLoaded', function() {
    const readMoreButtons = document.querySelectorAll('.read-more');

    readMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const moreContent = this.previousElementSibling;
            if (moreContent.style.display === 'none' || moreContent.style.display === '') {
                moreContent.style.display = 'block';
                this.textContent = 'READ LESS';
            } else {
                moreContent.style.display = 'none';
                this.textContent = 'READ MORE';
            }
        });
    });
});
