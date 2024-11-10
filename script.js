
document.addEventListener('DOMContentLoaded', () => {
    const cartBtn = document.getElementById('cart-btn');
    const cartDropdown = document.getElementById('cart-dropdown');

    
    cartBtn.addEventListener('click', () => {
        cartDropdown.classList.toggle('visible');
    });

   
    window.addEventListener('click', function(event) {
        if (!cartDropdown.contains(event.target) && !cartBtn.contains(event.target)) {
            cartDropdown.classList.remove('visible');
        }
    });
});





