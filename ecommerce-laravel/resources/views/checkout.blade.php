<x-template title="Checkout">
    <div class="container my-5">
        <h2>Checkout</h2>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No. HP</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <h4 class="mt-4">Ringkasan Keranjang</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
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
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ",", ".") }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($item['quantity'] * $item['price'], 0, ",", ".") }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Keranjang kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-end">
                <h4>Total Belanja: Rp {{ number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), 0, ",", ".") }}</h4>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Proses Checkout</button>
        </form>
    </div>
</x-template>
