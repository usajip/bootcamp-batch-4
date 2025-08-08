<x-template title="Home Page">
    @if($age > 18)
    <x-alert type="info" message="Your age is more than 18" />
    @elseif($age == 18)
    <x-alert type="success" message="Your age is exactly 18" />
    @else
    <x-alert type="warning" message="Your age is less than 18" />
    @endif
    <div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4">{{ $title }}</h1>
            <p class="lead">{{ $sub_title }}</p>
            <a href="#products" class="btn btn-primary btn-lg mt-3">Shop Now</a>
        </div>
    </div>
    <h2 id="products" class="mb-4">Popular Products</h2>
    <div class="row">
        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</div>
@push('styles')
    <style>
        /* Custom styles for the home page */
        .hero {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }
    </style>
@endpush
</x-template>