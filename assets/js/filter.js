function filter(query, target) {
    let filteredProducts = window.products.slice().filter(p => p.name.toLowerCase().startsWith(query.toLowerCase()));
    let productsHTML = "";
    filteredProducts.forEach(element => {
                let product = `
            <div class="card" style="width: 18rem;">
                <img height="60%" style="object-fit: cover;" class="card-img-top" src="${element.image ? `/uploads/${element.image}` : "assets/images/no-content.png"}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">${element.name}</h5>
                    <a href="${element.link}" class="btn btn-primary">Show Prices</a>
                </div>
            </div>
        `;
        productsHTML += product;
    });
    target.innerHTML = productsHTML;
}