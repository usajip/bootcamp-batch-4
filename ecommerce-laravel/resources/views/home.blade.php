<x-template title="Home Page">
    <div class="container p-0">
        <div class="row mb-4">
            <div class="col-12">
                <div class="swiper featuredSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('images/1.jpg') }}" class="img-fluid d-none d-md-block">
                            <img src="{{ asset('images/1_a.webp') }}" class="img-fluid d-block d-md-none">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/2.jpg') }}" class="img-fluid">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/3.jpg') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        
        <h2 id="product_popular" class="mb-4">Popular Products</h2>
        <div class="row">
            @forelse($popular_products as $product)
            <div class="col-md-6 col-lg-3 mb-4">
                <x-product-card :product="$product" />
            </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>
        <hr class="my-5" style="border-color: #b7b7b7;">
        <h2 id="products" class="mb-4">Other Products</h2>
        <div class="mb-4">
            <form method="GET" action="{{ route('home') }}">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            @forelse($products as $product)
            <div class="col-md-6 col-lg-3 mb-4">
                <x-product-card :product="$product" />
            </div>
            @empty
                <p>No products found.</p>
            @endforelse
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            /* Custom styles for the home page */
            .hero {
                background: url('https://via.placeholder.com/1920x600') no-repeat center center;
                background-size: cover;
                color: white;
                padding: 100px 0;
            }
            
            /* Swiper styles */
            .featuredSwiper {
                width: 100%;
                height: auto;
                margin: 20px auto;
            }
            
            .featuredSwiper .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0px;
            }
            
            .featuredSwiper .card {
                width: 100%;
                max-width: 300px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                border: none;
            }
            
            .swiper-button-next,
            .swiper-button-prev {
                color: #007bff;
            }
            
            .swiper-pagination-bullet-active {
                background: #007bff;
            }
        </style>
    @endpush
    
    @push('scripts')
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper('.featuredSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                });
            });
        </script>
    @endpush
</x-template>