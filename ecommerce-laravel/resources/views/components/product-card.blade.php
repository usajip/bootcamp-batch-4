
    <div class="card h-100 border-0 shadow-sm">
        <div style="height: 200px; overflow: hidden;border-radius: var(--bs-card-border-radius);">
            <img src="{{ asset('images/'.$product->image) }}" class="" alt="{{ $product->name }}" style="height: 100%; width: 100%; object-fit: cover;">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <sub class="mb-3">{{ $product->category->name }}</sub>
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{!! $product->description !!}</p>
            </div>
            <div class="d-flex flex-column justify-end">
                <span class="fw-bold text-primary mb-2">{{ "Rp " . number_format($product->price, 0, ",", ".") }}</span>
                <div class="mt-auto d-flex flex-column justify-between gap-2">
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-block btn-sm btn-success">Add to Cart</a>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-block btn-sm btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>