<x-template title="Home">
    <div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4">{{ $title }}</h1>
            <p class="lead">{{ $sub_title }}</p>
            <a href="#products" class="btn btn-primary btn-lg mt-3">Shop Now</a>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Featured Product">
                <div class="card-body">
                    <h5 class="card-title">Featured Product</h5>
                    <p class="card-text">High quality and best seller product for you.</p>
                    <a href="#" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="New Arrival">
                <div class="card-body">
                    <h5 class="card-title">New Arrival</h5>
                    <p class="card-text">Check out our latest collection just arrived.</p>
                    <a href="#" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Best Deals">
                <div class="card-body">
                    <h5 class="card-title">Best Deals</h5>
                    <p class="card-text">Grab the best deals before they're gone!</p>
                    <a href="#" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
    </div>
    <h2 id="products" class="mb-4">Popular Products</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product['name'] }}</h5>
                    <p class="card-text">{{ $product['description'] }}</p>
                    <div class="mt-auto">
                        <span class="fw-bold text-primary">{{ "Rp " . number_format($product['price'], 0, ",", ".") }}</span>
                        <a href="#" class="btn btn-sm btn-success float-end">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-template>