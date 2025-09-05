<x-template title="Detail Produk">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/'.$product->image) }}" class="img-fluid h-100 rounded" alt="Produk" style="max-height: 250px">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Kategori: {{ $product->category->name }}</p>
                <h4 class="text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed luctus libero vitae eros facilisis fermentum.</p>
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">Tambah ke Keranjang</a>
            </div>
        </div>
        <hr class="mt-5" style="border-color: #b7b7b7;">
        <h3 class="mt-5">Produk Rekomendasi</h3>
        <div class="row">
            @foreach($product_recommendations as $recommended)
                <div class="col-md-3 mb-4">
                    <x-product-card :product="$recommended" />
                </div>
            @endforeach
        </div>
    </div>
</x-template>
