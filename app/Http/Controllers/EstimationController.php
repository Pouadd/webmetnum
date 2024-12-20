<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstimationController extends Controller
{
    public function showForm()
    {
        return view('input_form');
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

        // Hitung jumlah yang dapat diproduksi untuk setiap produk
        $results = [];
        foreach ($produk as $p) {
            $jumlah_minyak = floor($bahan_baku['minyak_jelantah'] / $p['minyak_jelantah']);
            $jumlah_gliserin = floor($bahan_baku['gliserin'] / $p['gliserin']);
            $jumlah_pewarna = floor($bahan_baku['pewarna'] / $p['pewarna']);

            // Jumlah yang dapat diproduksi adalah nilai minimum dari bahan yang tersedia
            $jumlah = min($jumlah_minyak, $jumlah_gliserin, $jumlah_pewarna);

            $results[] = [
                'produk' => $p['produk'],
                'image' => $p['image'],
                'jumlah' => $jumlah,
            ];
        }

        // Kirim hasil ke view
        return view('input_form', compact('results'));
    }
}
