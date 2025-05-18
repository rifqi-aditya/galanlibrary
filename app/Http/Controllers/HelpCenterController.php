<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    //
    public function index()
    {

        $faqs =
            [
                'Pertanyaan Umum' =>
                [
                    [
                        'question' => 'Jam operasional perpustakaan SMA 39 kapan saja?',
                        'answer' => 'Perpustakaan SMA 39 buka dari Senin hingga Jumat, pukul 07.30 - 15.00 WIB, dan Sabtu pukul 08.00 - 12.00 WIB.'
                    ],
                    [
                        'question' => 'Bagaimana cara menjadi anggota perpustakaan?',
                        'answer' => 'Untuk menjadi anggota, siswa harus mendaftar dengan menunjukkan kartu pelajar dan mengisi formulir pendaftaran di meja layanan perpustakaan.'
                    ],
                    [
                        'question' => 'Apakah perpustakaan SMA 39 menyediakan layanan peminjaman buku?',
                        'answer' => 'Ya, perpustakaan menyediakan layanan peminjaman buku untuk semua anggota yang terdaftar.'
                    ],
                    [
                        'question' => 'Berapa lama batas waktu peminjaman buku?',
                        'answer' => 'Batas waktu peminjaman adalah 7 hari dengan kemungkinan perpanjangan 3 hari jika tidak ada pemesanan dari anggota lain.'
                    ],
                    [
                        'question' => 'Apa saja aturan yang harus dipatuhi di perpustakaan?',
                        'answer' => 'Aturan termasuk menjaga ketenangan, tidak membawa makanan/minuman, merawat koleksi buku, dan mengembalikan buku tepat waktu.'
                    ]
                ],
                'Tentang Koleksi Buku' => [
                    [
                        'question' => 'Bagaimana cara mencari buku yang saya butuhkan di perpustakaan?',
                        'answer' => 'Anda dapat mencari buku melalui katalog digital di komputer perpustakaan atau meminta bantuan pustakawan.'
                    ],
                    [
                        'question' => 'Apakah perpustakaan punya koleksi buku pelajaran untuk kelas 10, 11, dan 12?',
                        'answer' => 'Ya, kami memiliki koleksi lengkap buku pelajaran untuk semua kelas yang sesuai dengan kurikulum sekolah.'
                    ],
                    [
                        'question' => 'Apakah bisa memesan buku yang tidak tersedia di perpustakaan?',
                        'answer' => 'Ya, Anda dapat mengajukan permintaan buku melalui pustakawan untuk dipertimbangkan pembeliannya.'
                    ],
                    [
                        'question' => 'Apakah ada buku referensi atau jurnal untuk tugas sekolah?',
                        'answer' => 'Perpustakaan menyediakan berbagai buku referensi dan jurnal pendidikan yang dapat membantu penyelesaian tugas.'
                    ]
                ],
                'Layanan Digital' => [
                    [
                        'question' => 'Apakah perpustakaan menyediakan akses ke e-book atau jurnal digital?',
                        'answer' => 'Ya, perpustakaan menyediakan akses ke platform e-book dan jurnal digital yang dapat diakses dengan akun sekolah.'
                    ],
                    [
                        'question' => 'Bagaimana cara mengakses komputer atau WiFi di perpustakaan?',
                        'answer' => 'Komputer perpustakaan dapat digunakan dengan login menggunakan NIS, sedangkan WiFi menggunakan akun sekolah yang sama.'
                    ],
                    [
                        'question' => 'Apakah ada layanan konsultasi atau bantuan dari pustakawan secara online?',
                        'answer' => 'Ya, Anda dapat menghubungi pustakawan melalui email perpustakaan atau platform sekolah selama jam kerja.'
                    ]
                ],
                'Peminjaman dan Pengembalian' => [
                    [
                        'question' => 'Bagaimana cara meminjam buku di perpustakaan SMA 39?',
                        'answer' => 'Bawa buku yang ingin dipinjam ke meja sirkulasi dengan menunjukkan kartu anggota, pustakawan akan memproses peminjaman.'
                    ],
                    [
                        'question' => 'Bagaimana prosedur mengembalikan buku yang sudah dipinjam?',
                        'answer' => 'Bawa buku ke meja pengembalian, pustakawan akan memeriksa kondisi buku dan mencatat pengembalian.'
                    ],
                    [
                        'question' => 'Apakah ada denda jika terlambat mengembalikan buku?',
                        'answer' => 'Ya, denda keterlambatan Rp2.000 per hari per buku dengan maksimal denda Rp20.000 per buku.'
                    ],
                    [
                        'question' => 'Apa yang harus saya lakukan jika buku yang saya pinjam rusak atau hilang?',
                        'answer' => 'Segera laporkan ke pustakawan. Untuk buku rusak, mungkin dikenakan biaya perbaikan. Untuk buku hilang, wajib mengganti dengan buku yang sama atau membayar sesuai harga buku.'
                    ]
                ],
                'Lain-lain' => [
                    [
                        'question' => 'Apakah boleh membawa makanan atau minuman ke dalam perpustakaan?',
                        'answer' => 'Tidak diperbolehkan membawa makanan/minuman ke area perpustakaan untuk menjaga kebersihan dan koleksi buku.'
                    ],
                    [
                        'question' => 'Bagaimana cara menghubungi pustakawan atau staf perpustakaan?',
                        'answer' => 'Anda dapat menghubungi via telepon (021) 1234567 ext. 123, email perpustakaan@sma39.edu, atau langsung datang ke perpustakaan.'
                    ]
                ]
            ];
        return view('help.center', ['faqs' => $faqs]);
    }
}
