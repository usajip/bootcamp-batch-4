<div class="col-md-3 mb-4">
    <div class="card h-100 border-0 shadow-sm">
        <div style="height: 200px; overflow: hidden;">
            <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        </div>
        <div class="card-body d-flex flex-column">
            <sub class="mb-3">{{ $product->category->name }}</sub>
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{!! $product->description !!}</p>
            <span class="fw-bold text-primary">{{ "Rp " . number_format($product->price, 0, ",", ".") }}</span>
            <div class="mt-auto d-flex justify-between">
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-sm btn-success float-end ms-2">Add to Cart</a>
                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm btn-primary float-end">Detail</a>
            </div>
        </div>
    </div>
</div>