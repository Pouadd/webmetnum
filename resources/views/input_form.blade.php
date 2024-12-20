<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gauss-Jordan Solver</title>
        <link rel="stylesheet" href="{{ asset('css/proses.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>

    <h2>Input Bahan Baku</h2>
    <form action="{{ route('process.data') }}" method="POST">
        @csrf
        <label for="minyak_jelantah">Minyak Jelantah (ml):</label><br>
        <input type="number" id="minyak_jelantah" name="minyak_jelantah" required><br><br>

        <label for="gliserin">Gliserin (ml):</label><br>
        <input type="number" id="gliserin" name="gliserin" required><br><br>

        <label for="pewarna">Pewarna (gram):</label><br>
        <input type="number" id="pewarna" name="pewarna" required><br><br>

        <button type="submit">Hitung</button>
    </form>

    <!-- Hasil Perhitungan -->
    @if (isset($results))
        <h2>Hasil Estimasi Produksi</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            @foreach ($results as $result)
                <div style="text-align: center; width: 200px;">
                    <img src="{{ asset('image/' . $result['image']) }}" alt="{{ $result['produk'] }}" style="width: 100%; height: auto;">
                    <p>{{ $result['produk'] }}</p>
                    <p><strong>Jumlah: {{ $result['jumlah'] }}</strong></p>
                </div>
            @endforeach
        </div>
    @endif
    <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>
        </div>
    <script src="{{ asset('js/proses.js') }}"></script>
    </body>
</html> 
