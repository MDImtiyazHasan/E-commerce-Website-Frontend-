// data/homepage.js - Load products from localStorage (staff portal)

// Load products from localStorage (added by staff)
function getProductsFromStorage() {
    const staffProducts = localStorage.getItem('novapass_products');
    return staffProducts ? JSON.parse(staffProducts) : [];
}

// Default products (always shown)
const defaultProducts = [
  {
    id:"001",
    name:"Galaxy Watch 6",
    image:"Homepage_img/products/watch.jpg",
    rating: {
      stars: "★★★★☆",
      rate:"(4.6)"
    },
    cprice:"$349"
  },
  {
    id:"002",
    name:"iPhone 15 Pro Max",
    image:"Homepage_img/products/iphone.jpeg",
    rating: {
      stars: "★★★★★",
      rate:"(4.9)"
    },
    cprice:"$1,199",
    oprice:"$1,399"
  },
  {
    id:"003",
    name:"AirPods Pro 2nd Gen",
    image:"Homepage_img/products/headphones2.jpg",
    rating: {
      stars: "★★★★★",
      rate:"(4.8)"
    },
    cprice:"$249",
    oprice:"$299"
  },
  {
    id:"004",
    name:"MacBook Pro 14 M3 Pro",
    image:"Homepage_img/products/laptop.jpeg",
    rating: {
      stars: "★★★★★",
      rate:"(5.0)"
    },
    cprice:"$1,999"
  }
];

// Combine default products with staff products (staff products come after)
const staffProducts = getProductsFromStorage();
const products = [...defaultProducts, ...staffProducts];