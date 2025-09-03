<x-template title="Keranjang Belanja">
    <div class="container my-5">
        <h2>Keranjang Belanja</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cart as $id => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('images/'.$item['image']) }}" alt="{{ $item['name'] }}" style="width: 100px;">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ",", ".") }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </form>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline ms-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk dari keranjang?')">Delete</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['quantity'] * $item['price'], 0, ",", ".") }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Keranjang kosong
                        <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Belanja Sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total Belanja: Rp {{ number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), 0, ",", ".") }}</h4>
            <a href="{{ route('checkout') }}" class="btn btn-primary {{ count($cart) <= 0 ? 'disabled' : '' }}">Checkout</a>
        </div>
    </div>
</x-template>
