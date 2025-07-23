const products = [
      {
        name: "Whey Protein",
        description: "Suplemen protein untuk otot.",
        price: 250000,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdq4stOjK6Inhd7D5n-pkZn7_A2YT2DS1YeA&s",
        category: "Suplemen"
      },
      {
        name: "Barbel 10kg",
        description: "Alat angkat beban 10kg.",
        price: 150000,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdq4stOjK6Inhd7D5n-pkZn7_A2YT2DS1YeA&s",
        category: "Alat Olahraga"
      },
      {
        name: "T-Shirt Gym",
        description: "Kaos olahraga nyaman.",
        price: 80000,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdq4stOjK6Inhd7D5n-pkZn7_A2YT2DS1YeA&s",
        category: "Apparel"
      },
      {
        name: "BCAA Recovery",
        description: "Membantu pemulihan setelah latihan.",
        price: 200000,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdq4stOjK6Inhd7D5n-pkZn7_A2YT2DS1YeA&s",
        category: "Suplemen"
      },
      {
        name: "Yoga Mat",
        description: "Matras olahraga anti-slip.",
        price: 120000,
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdq4stOjK6Inhd7D5n-pkZn7_A2YT2DS1YeA&s",
        category: "Alat Olahraga"
      }
    ];

function renderProducts(data) {
    const productList = document.getElementById("productList");
    productList.innerHTML = "";

    if (data.length === 0) {
    productList.innerHTML = '<p class="text-center">Produk tidak ditemukan.</p>';
    return;
    }

    data.forEach((product) => {
    const card = `
        <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="${product.image}" class="card-img-top" alt="${product.name}">
            <div class="card-body">
            <h5 class="card-title">${product.name}</h5>
            <p class="card-text">${product.description}</p>
            <p class="text-muted">Kategori: ${product.category}</p>
            <h6 class="text-primary">Rp ${product.price.toLocaleString()}</h6>
            </div>
        </div>
        </div>
    `;
    productList.innerHTML += card;
    });
}

function applyFilters() {
    let filtered = [...products];
    const search = document.getElementById("searchInput").value.toLowerCase();
    const category = document.getElementById("categoryFilter").value;
    const priceSort = document.getElementById("priceSort").value;

    if (search) {
    filtered = filtered.filter(p => p.name.toLowerCase().includes(search));
    }

    if (category) {
    filtered = filtered.filter(p => p.category === category);
    }

    if (priceSort === "asc") {
    filtered.sort((a, b) => a.price - b.price);
    } else if (priceSort === "desc") {
    filtered.sort((a, b) => b.price - a.price);
    }

    renderProducts(filtered);
}

// Event Listeners
document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("categoryFilter").addEventListener("change", applyFilters);
document.getElementById("priceSort").addEventListener("change", applyFilters);

// Initial render
renderProducts(products);