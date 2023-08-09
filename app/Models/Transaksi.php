<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table="transaksi";
    public $primaryKey = 'id_transaksi';
    protected $fillable = [
        'tujuan', 'nominal','kategori','metode','trx','app','admin','fee','tax','total', 'created_at'
    ];

    // Fungsi untuk menampilkan jumlah data transaksi sesuai hari ini
    public static function countTransaksiToday()
    {
        $today = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format Y-m-d

        return self::whereDate('created_at', $today)->count();
    }


     // Fungsi untuk menampilkan jumlah keseluruhan total transaksi pada hari ini
     public static function totalTransaksiToday()
     {
         $today = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format Y-m-d
 
         // Mengambil data transaksi berdasarkan tanggal hari ini
         $transaksiToday = self::whereDate('created_at', $today)->get();
 
         $total = 0; // Inisialisasi variabel untuk menghitung jumlah total
 
         // Looping data transaksi hari ini dan mengakumulasikan nilai total ke variabel $total
         foreach ($transaksiToday as $transaksi) {
             // Hapus karakter non-angka seperti 'Rp' dan tanda titik '.'
             $nilaiTotal = (int) preg_replace("/[^0-9-]/", "",  $transaksi->total);
 
             $total += $nilaiTotal;
         }
 
         return $total;
     }

     // Fungsi untuk menampilkan jumlah keseluruhan total transaksi pada hari ini
     public static function totalMarginAdmin()
     {
         $today = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format Y-m-d
 
         // Mengambil data transaksi berdasarkan tanggal hari ini
         $transaksiToday = self::whereDate('created_at', $today)->get();
 
         $admin = 0; // Inisialisasi variabel untuk menghitung jumlah total
 
         // Looping data transaksi hari ini dan mengakumulasikan nilai total ke variabel $total
         foreach ($transaksiToday as $transaksi) {
             // Hapus karakter non-angka seperti 'Rp' dan tanda titik '.'
             $nilaiTotal = (int) preg_replace("/[^0-9]/", "", $transaksi->admin);
 
             $admin += $nilaiTotal;
         }
 
         return $admin;
     }

     // Fungsi untuk menampilkan jumlah keseluruhan total transaksi pada hari ini
     public static function totalPendapatan()
     {
         $today = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format Y-m-d
 
         // Mengambil data transaksi berdasarkan tanggal hari ini
         $transaksiToday = self::whereDate('created_at', $today)->get();
 
         $fee = 0; // Inisialisasi variabel untuk menghitung jumlah total
 
         // Looping data transaksi hari ini dan mengakumulasikan nilai total ke variabel $total
         foreach ($transaksiToday as $transaksi) {
             // Hapus karakter non-angka seperti 'Rp' dan tanda titik '.'
             $nilaiTotal = (int) preg_replace("/[^0-9-]/", "",  $transaksi->fee);
 
             $fee += $nilaiTotal;
         }
 
         return $fee;
     }
    

 
}
