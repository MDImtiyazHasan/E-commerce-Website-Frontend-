let productHtml= '';


products.forEach((products)=> {

    
if(!products.oprice){

      productHtml += `
      <div class="product-card">
            <div class="product-image">
                <img src="${products.image}">
                <button class="wishlist-btn"><i class="far fa-heart"></i></button>
            </div>
            <div class="product-info">
                <h3 class="product-title">${products.name}</h3>
                <div class="product-rating">
                    <span class="stars">${products.rating.stars}</span>
                    <span class="rating-text">${products.rating.rate}</span>
                </div>
                <div class="product-price">
                    <span class="current-price">${products.cprice}</span>
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
            </div>
        </div>
 
  `

}

else {

      productHtml += `
      <div class="product-card">
            <div class="product-image">
                <img src="${products.image}">
                <button class="wishlist-btn"><i class="far fa-heart"></i></button>
            </div>
            <div class="product-info">
                <h3 class="product-title">${products.name}</h3>
                <div class="product-rating">
                    <span class="stars">${products.rating.stars}</span>
                    <span class="rating-text">${products.rating.rate}</span>
                </div>
                <div class="product-price">
                    <span class="current-price">${products.cprice}</span>
                    <span class="old-price">${products.oprice}</span>
                </div>
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
            </div>
        </div>
 
  `

}


});

document.querySelector('.js-products-grid').innerHTML = productHtml;

