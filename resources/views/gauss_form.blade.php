<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gauss-Jordan Estimasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .step-card {
            display: none;
        }
        .step-card.active {
            display: block;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Gauss-Jordan Estimasi</h1>

        <!-- Form Input -->
        <div class="card shadow mb-4">
            <div class="card-header text-white bg-primary">
                Input Bahan Baku
            </div>
            <div class="card-body">
                <form action="{{ route('gauss.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="minyak_jelantah" class="form-label">Minyak Jelantah (ml):</label>
                        <input type="number" id="minyak_jelantah" name="minyak_jelantah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gliserin" class="form-label">Gliserin (ml):</label>
                        <input type="number" id="gliserin" name="gliserin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pewarna" class="form-label">Pewarna (gram):</label>
                        <input type="number" id="pewarna" name="pewarna" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung Estimasi</button>
                </form>
            </div>
        </div>

        <!-- Hasil Perhitungan -->
        @if (isset($results))
            <div class="card shadow mb-4">
                <div class="card-header text-white bg-success">
                    Hasil Estimasi Produksi
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($results as $result)
                            <div class="col-md-4 text-center mb-3">
                                <img src="{{ asset('image/' . $result['image']) }}" alt="{{ $result['produk'] }}" class="img-fluid mb-2" style="max-width: 150px;">
                                <p class="mb-1"><strong>{{ $result['produk'] }}</strong></p>
                                <p>Jumlah: <strong>{{ $result['jumlah'] }}</strong></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Langkah-langkah Gauss-Jordan -->
        @if (isset($steps))
            <div class="card shadow mb-4">
                <div class="card-header text-white bg-info">
                    Langkah-langkah Gauss-Jordan
                </div>
                <div class="card-body">
                    @foreach ($steps as $index => $step)
                        <div class="step-card @if ($index == 0) active @endif" id="step-{{ $index }}">
                            <h5>Langkah {{ $index + 1 }}</h5>
                            <p>{{ $step['step'] }}</p>
                            <pre class="bg-light p-3 rounded">
{{ json_encode($step['matrix'], JSON_PRETTY_PRINT) }}
                            </pre>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-secondary" id="prevStep" style="display: none;">Sebelumnya</button>
                    <button class="btn btn-primary" id="nextStep">Berikutnya</button>
                </div>
            </div>
        @endif

        <!-- Tombol Kembali ke Home -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const steps = document.querySelectorAll('.step-card');
            const nextBtn = document.getElementById('nextStep');
            const prevBtn = document.getElementById('prevStep');
            let currentStep = 0;

            function updateSteps() {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                // Tampilkan atau sembunyikan tombol navigasi
                prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
                nextBtn.textContent = currentStep < steps.length - 1 ? 'Berikutnya' : 'Selesai';
            }

            nextBtn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateSteps();
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateSteps();
                }
            });

            updateSteps(); // Inisialisasi tampilan
        });
    </script>
</body>
</html>
