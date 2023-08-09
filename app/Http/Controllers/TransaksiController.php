<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Dompdf\Dompdf;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Transaksi::all();
        return view('website.test', compact('data'));

    }

        // $data = Transaksi::all();
        // $transaksibaru = Transaksi::countTransaksiToday();
        // $totaltransaksibaru = Transaksi::totalTransaksiToday();
        // $totalmarginbaru = Transaksi::totalMarginAdmin();
        // $totalpendapatanbaru = Transaksi::totalPendapatan();

        // return view('website.test', compact('data','transaksibaru', 'totaltransaksibaru', 'totalmarginbaru', 'totalpendapatanbaru'));
    

    public function dashboard(){
        $transaksibaru = Transaksi::countTransaksiToday();
        $totaltransaksibaru = Transaksi::totalTransaksiToday();
        $totalmarginbaru = Transaksi::totalMarginAdmin();
        $totalpendapatanbaru = Transaksi::totalPendapatan();

        return view('dashboard', compact('transaksibaru', 'totaltransaksibaru', 'totalmarginbaru', 'totalpendapatanbaru'));

    }

    

    public function report(Request $request){
        $query = Transaksi::query();

        // Filter berdasarkan pencarian
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('kategori', 'LIKE', '%' . $search . '%')
                    ->orWhere('tujuan', 'LIKE', '%' . $search . '%')
                    ->orWhere('nominal', 'LIKE', '%' . $search . '%')
                    ->orWhere('metode', 'LIKE', '%' . $search . '%')
                    ->orWhere('trx', 'LIKE', '%' . $search . '%')
                    ->orWhere('app', 'LIKE', '%' . $search . '%')
                    ->orWhere('admin', 'LIKE', '%' . $search . '%')
                    ->orWhere('tax', 'LIKE', '%' . $search . '%')
                    ->orWhere('fee', 'LIKE', '%' . $search . '%')
                    ->orWhere('total', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter berdasarkan rentang tanggal
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($dateFrom && $dateTo) {
            $dateFrom = Carbon::parse($dateFrom)->startOfDay();
            $dateTo = Carbon::parse($dateTo)->endOfDay();
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }

        // Filter berdasarkan bulan dan tahun
        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year) {
            $monthYear = Carbon::parse($year . '-' . $month)->startOfMonth();
            $query->whereBetween('created_at', [$monthYear, $monthYear->copy()->endOfMonth()]);
        } else if ($month) {
            $monthYear = Carbon::parse($month)->startOfMonth();
            $query->whereBetween('created_at', [$monthYear, $monthYear->copy()->endOfMonth()]);
        } else if ($year) {
            $year = Carbon::parse($year)->startOfYear();
            $query->whereBetween('created_at', [$year, $year->copy()->endOfYear()]);
        }

        // Filter berdasarkan hari ini
        $filterPerHari = $request->input('sekarang');
        if ($filterPerHari) {
            $query->whereDate('created_at', Carbon::today());
        }

        // Filter berdasarkan 7 hari terakhir
        $filterPer7Hari = $request->input('minggu');
        if ($filterPer7Hari) {
            $query->whereBetween('created_at', [Carbon::today()->subDays(7), Carbon::today()]);
        }

         // Filter berdasarkan 30 hari terakhir
        $filterPerBulan = $request->input('30hari');
        if ($filterPerBulan) {
            $query->whereBetween('created_at', [Carbon::today()->subDays(30), Carbon::today()]);
        }

        
        $data = $query->get();

        

         // Menjumlahkan nominal, TRX, APP, Admin, Tax, dan Fee
         $totalNominal = $data->sum(function ($transaksi) {
            // Hapus karakter non-angka seperti 'Rp', tanda titik '.', dan tanda koma ','
            $cleanedNominal = (int) preg_replace("/[^0-9]/", "", $transaksi->nominal);
            if (!is_numeric($cleanedNominal)) {
                // Jika nilai cleanedNominal bukan angka, maka tampilkan pesan error
                dd("Non-numeric value encountered in nominal: " . $transaksi->nominal);
            }
            return $cleanedNominal;
        });
  

        // Menjumlahkan Admin
        $totalAdmin = $data->sum(function ($transaksi) {
            // Hapus karakter non-angka seperti 'Rp', tanda titik '.', dan tanda koma ','
            $cleanedAdmin = (int) preg_replace("/[^0-9]/", "", $transaksi->admin);
            if (!is_numeric($cleanedAdmin)) {
                // Jika nilai cleanedAdmin bukan angka, maka tampilkan pesan error
                dd("Non-numeric value encountered in Admin: " . $transaksi->admin);
            }
            return $cleanedAdmin;
        });

        // Menjumlahkan Tax
        $totalTax = $data->sum(function ($transaksi) {
            // Hapus karakter non-angka seperti 'Rp', tanda titik '.', dan tanda koma ','
            $cleanedTax = (int) preg_replace("/[^0-9]/", "", $transaksi->tax);
            if (!is_numeric($cleanedTax)) {
                // Jika nilai cleanedTax bukan angka, maka tampilkan pesan error
                dd("Non-numeric value encountered in Tax: " . $transaksi->tax);
            }
            return $cleanedTax;
        });

        // Menjumlahkan Fee
        $totalFee = $data->sum(function ($transaksi)  {
            // Hapus karakter non-angka seperti 'Rp', tanda titik '.', dan tanda koma ','
            $cleanedFee = (int) preg_replace("/[^0-9-]/", "", $transaksi->fee);

            if (!is_numeric($cleanedFee)) {
                // Jika nilai cleanedFee bukan angka, maka tampilkan pesan error
                dd("Non-numeric value encountered in Fee: " . $transaksi->fee);
            }
            // Kembalikan nilai cleanedFee agar metode sum() dapat mengakumulasikan jumlah fee
            return $cleanedFee;
        }); 

         // Menjumlahkan total
         $total = $data->sum(function ($transaksi) {
            // Hapus karakter non-angka seperti 'Rp', tanda titik '.', dan tanda koma ','
            $cleanedTotal = (int) preg_replace("/[^0-9]/", "", $transaksi->total);
            if (!is_numeric($cleanedTotal)) {
                // Jika nilai cleanedFee bukan angka, maka tampilkan pesan error
                dd("Non-numeric value encountered in Fee: " . $transaksi->total);
            }
            return $cleanedTotal;

        });    

        // Mengubah format nilai menjadi format rupiah
        function formatRupiah($value) {
            return "Rp " . number_format($value, 0, ',', '.');
        }

        $totalNominalRupiah = formatRupiah($totalNominal);
        $totalAdminRupiah = formatRupiah($totalAdmin);
        $totalTaxRupiah = formatRupiah($totalTax);
        $totalFeeRupiah = formatRupiah($totalFee);
        $totalTotalRupiah = formatRupiah($total);
        
    
        return view('website.report', compact('data', 'totalNominalRupiah', 'totalTotalRupiah', 'totalAdminRupiah', 'totalTaxRupiah', 'totalFeeRupiah'));

    }

    public function transaksi(){
        $data=Transaksi::all();
        return view('website.transaksi', compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'tujuan' => 'required|string',
            'nominal' => 'required|string',
            'kategori' => 'required|string',
            'metode' => 'required|string',
            'trx' => 'nullable|string',
            'app' => 'nullable|string',
            'total' => 'required|string',
            'admin' => 'required|string',
            'tax' => 'nullable|string',
            'fee' => 'nullable|string',
            'created_at' => 'required|date', 

        ]);

      

        // Buat objek Transaksi baru
        $transaksi = new Transaksi;
        $transaksi->tujuan = $validatedData['tujuan'];
        $transaksi->nominal = $validatedData['nominal'];
        $transaksi->kategori = $validatedData['kategori'];
        $transaksi->metode = $validatedData['metode'];
        $transaksi->trx = $validatedData['trx'];
        $transaksi->app = $validatedData['app'];
        $transaksi->total = $validatedData['total'];
        $transaksi->admin = $validatedData['admin'];
        $transaksi->tax = $validatedData['tax'];
        $transaksi->fee = $validatedData['fee'];
        $transaksi->created_at = \Carbon\Carbon::createFromFormat('Y-m-d', $validatedData['created_at']);
        

        // Simpan transaksi ke database
        $transaksi->save();

        return redirect('/transaksi')->with('status', 'Data berhasil ditambahkan!!');
    }

    public function clearFilter()
    {
        return redirect('/transaksi');
    }

    public function destroy($id_transaksi)
    {
        try {
           
            $transaksi=Transaksi::find($id_transaksi);
            $transaksi->delete();
            return redirect('/report')->with('status', 'Data berhasil dihapus!!');
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ]);
        }
    }

   
  
}
