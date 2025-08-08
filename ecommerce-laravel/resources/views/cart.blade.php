<x-template title="Keranjang Belanja">
    <div class="container my-5">
        <h2>Keranjang Belanja</h2>
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
                <tr>
                    <td>1</td>
                    <td>Produk 1</td>
                    <td>Rp 100.000</td>
                    <td>2</td>
                    <td>Rp 200.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Produk 2</td>
                    <td>Rp 150.000</td>
                    <td>1</td>
                    <td>Rp 150.000</td>
                </tr>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total Belanja: Rp 350.000</h4>
            <a href="#" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</x-template>
