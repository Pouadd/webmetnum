<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaussJordanController extends Controller
{
    public function showForm()
    {
        return view('gauss_form');
    }

    public function processData(Request $request)
    {
        // Ambil data input dari form
        $bahan_baku = [
            'minyak_jelantah' => $request->input('minyak_jelantah'),
            'gliserin' => $request->input('gliserin'),
            'pewarna' => $request->input('pewarna'),
        ];

        // Komposisi produk
        $produk = [
            [
                'produk' => 'Kecil',
                'minyak_jelantah' => 3,
                'gliserin' => 1,
                'pewarna' => 1,
                'image' => 'kecil.jpg',
            ],
            [
                'produk' => 'Sedang',
                'minyak_jelantah' => 5,
                'gliserin' => 2,
                'pewarna' => 2,
                'image' => 'sedang.jpg',
            ],
            [
                'produk' => 'Besar',
                'minyak_jelantah' => 7,
                'gliserin' => 3,
                'pewarna' => 3,
                'image' => 'besar.jpg',
            ],
        ];

        // Buat matriks augmented
        $matrix = [
            [$produk[0]['minyak_jelantah'], $produk[0]['gliserin'], $produk[0]['pewarna'], $bahan_baku['minyak_jelantah']],
            [$produk[1]['minyak_jelantah'], $produk[1]['gliserin'], $produk[1]['pewarna'], $bahan_baku['gliserin']],
            [$produk[2]['minyak_jelantah'], $produk[2]['gliserin'], $produk[2]['pewarna'], $bahan_baku['pewarna']],
        ];

        // Validasi matriks
        if (!$this->isValidMatrix($matrix)) {
            return back()->withErrors(['message' => 'Input bahan baku tidak menciptakan matriks valid untuk eliminasi Gauss-Jordan.']);
        }

        // Langkah eliminasi Gauss-Jordan
        $steps = $this->gaussJordanSteps($matrix);

        // Hitung hasil produksi
        $results = [];
        foreach ($produk as $p) {
            $jumlah_minyak = floor($bahan_baku['minyak_jelantah'] / $p['minyak_jelantah']);
            $jumlah_gliserin = floor($bahan_baku['gliserin'] / $p['gliserin']);
            $jumlah_pewarna = floor($bahan_baku['pewarna'] / $p['pewarna']);

            $jumlah = min($jumlah_minyak, $jumlah_gliserin, $jumlah_pewarna);

            $results[] = [
                'produk' => $p['produk'],
                'image' => $p['image'],
                'jumlah' => $jumlah,
            ];
        }

        // Kirim hasil dan langkah-langkah ke view
        return view('gauss_form', compact('steps', 'results'));
    }

    private function gaussJordanSteps(array $matrix)
    {
        $steps = [];
        $rows = count($matrix);
        $cols = count($matrix[0]);
    
        for ($i = 0; $i < $rows; $i++) {
            // Periksa elemen diagonal utama
            if ($matrix[$i][$i] == 0) {
                $swapped = false;
                for ($k = $i + 1; $k < $rows; $k++) {
                    if ($matrix[$k][$i] != 0) {
                        // Tukar baris
                        $temp = $matrix[$i];
                        $matrix[$i] = $matrix[$k];
                        $matrix[$k] = $temp;
                        $steps[] = ['step' => "Tukar baris $i dengan baris $k", 'matrix' => $matrix];
                        $swapped = true;
                        break;
                    }
                }
    
                if (!$swapped) {
                    // Lewati langkah ini jika tidak ada baris yang dapat ditukar
                    $steps[] = ['step' => "Lewati baris $i karena elemen diagonal nol dan tidak dapat ditukar", 'matrix' => $matrix];
                    continue;
                }
            }
    
            // Normalisasi baris
            $divisor = $matrix[$i][$i];
            for ($j = 0; $j < $cols; $j++) {
                $matrix[$i][$j] /= $divisor;
            }
            $steps[] = ['step' => "Normalisasi baris $i", 'matrix' => $matrix];
    
            // Eliminasi baris lainnya
            for ($k = 0; $k < $rows; $k++) {
                if ($k != $i) {
                    $factor = $matrix[$k][$i];
                    for ($j = 0; $j < $cols; $j++) {
                        $matrix[$k][$j] -= $factor * $matrix[$i][$j];
                    }
                    $steps[] = ['step' => "Eliminasi baris $k menggunakan baris $i", 'matrix' => $matrix];
                }
            }
        }
    
        return $steps;
    }
    

    private function isValidMatrix(array $matrix): bool
    {
        foreach ($matrix as $i => $row) {
            if ($row[$i] == 0 && !array_filter(array_column($matrix, $i))) {
                return false; // Jika elemen diagonal dan semua elemen di kolom nol
            }
        }
        return true;
    }
    
}