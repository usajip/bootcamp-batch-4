<div class="col-md-3 mb-4">
    <div class="card h-100 border-0 shadow-sm">
        <img src="{{ asset('images/laptop.jpeg') }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body d-flex flex-column">
            <sub class="mb-3">{{ $product->category->name }}</sub>
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <div class="mt-auto">
                <span class="fw-bold text-primary">{{ "Rp " . number_format($product->price, 0, ",", ".") }}</span>
                <a href="#" class="btn btn-sm btn-success float-end">Add to Cart</a>
            </div>
        </div>
    </div>
</div>