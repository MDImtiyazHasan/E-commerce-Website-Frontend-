// scripts/homepage-main.js - SUPER SIMPLE VERSION

let html = '';
products.forEach(p => {
    html += `
        <div class="product-card">
            <div class="product-image">
                <img src="${p.image}" alt="${p.name}">
                <button class="wishlist-btn"><i class="far fa-heart"></i></button>
            </div>
            <div class="product-info">
                <h3 class="product-title">${p.name}</h3>
                <div class="product-rating">
                    <span class="stars">${p.rating.stars}</span>
                    <span class="rating-text">${p.rating.rate}</span>
                </div>
                <div class="product-price">
                    <span class="current-price">${p.cprice}</span>
                    ${p.oprice ? `<span class="old-price">${p.oprice}</span>` : ''}
                </div>
                <button class="add-to-cart-btn" 
                        data-id="${p.id}" 
                        data-name="${p.name}" 
                        data-price="${p.cprice.replace(/[^0-9]/g,'')}"
                        data-image="${p.image}">
                    Add to Cart
                </button>
            </div>
        </div>`;
});

document.querySelector('.js-products-grid').innerHTML = html;

// === SUPER SIMPLE ADD TO CART ===
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = btn.dataset.price;
        const image = btn.dataset.image;

        fetch('add-to-cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}&name=${name}&price=${price}&image=${image}`
        })
        .then(r => r.text())
        .then(count => {
            document.querySelector('.cart-count').textContent = count;
            btn.textContent = 'Added!';
            btn.style.background = 'green';
            btn.style.color = 'white';
            setTimeout(() => {
                btn.textContent = 'Add to Cart';
                btn.style.background = '#F5E7C6';
                btn.style.color = 'black';
            }, 1000);
        });
    });
});