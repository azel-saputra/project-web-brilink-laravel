<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            margin: 0;
            background-color: #35363a;
            /* color: #dadce0; */
        }

        h1 {
            text-align: center;
        }

        .red-text {
        color: red;
        }

        .green-text {
        color: green;
        }

        .blue-text{
            color: blue;
        }
        .card{
            background-color: #27282A;
            color: #dadce0; 
        }

        .navbar{
            background-color: #27282A;
            color: #dadce0;
        }

        .item-sidebar{
            background-color: #27282A;
            color: #dadce0
        }

        body{
            background-color: #35363a;
            color: #dadce0;
        }

        .table{
            background-color: #27282A;
            color: #dadce0
        }

         .container-fluid{
                width: 200vh;
                margin: 100px;
            
            }

        .sidebar{
            width: 300px
        }

        #year{
            width: 100px
        }

        .filter{
            margin-top: 50px;
        }

        .btn-filter{
            width: 200px;
        }

        
        @media (min-width: 2000px) and (min-height: 1200px) {
            #year{
            width: 100px
        }

         
        }

        .flex-container {
        display: flex;
        justify-content: space-between;
        }

        .flex-item {
            margin-right: 10px;
        }

   


     

      
    </style>
</head>
<body >
     <!--navbar-->
     <nav class="navbar navbar-inverse ">
        <div class="">
            <div class="navbar-header">
            
                <h2 class="navbar-brand" href="#">CHIEN BRILink</h2>
            </div>
        </div>
    </nav>

    <div class="d-flex" id="wrapper">
            <!--sidebar-->

            <div class=" p-1 sidebar" id="sidebar-wrapper" style="height:100vh ">
                <a class="item-sidebar h5 list-group-item list-group-item-action list-group-item-light p-3 " href="{{route('dashboard')}}" style="text-align: center">Dashboard</a>
                <a class="item-sidebar h5 list-group-item list-group-item-action list-group-item-light p-3 " href="{{route('transaksi')}}" style="text-align: center">Transaction</a>
                {{-- <a class="item-sidebar h5 list-group-item list-group-item-action list-group-item-light p-3 " href="{{route('test')}}" style="text-align: center">Test Ui</a> --}}

                <a class="item-sidebar h5 list-group-item list-group-item-action list-group-item-light p-3 " href="{{route('report')}}" style="text-align: center">Report</a>

                <div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class=" item-sidebar h5 list-group-item list-group-item-action list-group-item-light p-3 " style="text-align: center; color: red" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <img src="" style="width: 25px"> {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>


            <div class="container-fluid my-4 bg-dark  rounded shadow-sm ">
            <!-- search data -->
           
                <div class="ml-auto p-2 card">
                    <form action="/report" method="GET">
                        <div class="row g-3 align-items-center">
                            
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Search</label>

                                <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search Here">
                            </div>
                            <div class="col-auto">
                                <label for="date_from" class="col-form-label">Date From</label>
                                <input type="date" id="date_from" name="date_from" class="form-control">
                            </div>
                            <div class="col-auto">
                                <label for="date_to" class="col-form-label">Date To</label>
                                <input type="date" id="date_to" name="date_to" class="form-control">
                            </div>

                            <div class="col-auto">
                                <label for="month">Month</label>
                                <input type="month" id="month" name="month" class="form-control">
                            </div>
                            <div class="col-auto" >
                                <label for="year">Year</label>
                                <input type="number" id="year" name="year" class="form-control" placeholder="Year">
                            </div>

    
                            <div class="col-auto filter">
                                <button type="submit" class="btn btn-primary btn-filter">Filter</button>
                                <a href="/report" class="btn btn-secondary">Clear Filter</a>
                            </div>
                        </div>
                    </form>
                    <div class="col-auto mt-4 mb-4">
                    </div>

                    <!-- Tambahkan div dengan class "flex-container" untuk mengatur layout tombol -->
                    <div class="flex-container mb-3">
                        <!-- Tombol-tombol filter tetap berada di kiri -->
                        <div>
                            <a href="{{ route('report', ['sekarang' => true]) }}" class="btn btn-primary">Today</a>
                            <a href="{{ route('report', ['minggu' => true]) }}" class="btn btn-primary">Last Seven Days</a>
                            <a href="{{ route('report', ['30hari' => true]) }}" class="btn btn-primary">Last Thirty Days</a>
                        </div>

                        <!-- Tombol print berada di ujung kanan -->
                        <div class="flex-item">
                            <button type="button" class="btn btn-success" onclick="printTable()">Print</button>
                            <button type="button" class="btn btn-success btnDlt" onclick="controllerDlt()">Edit</button>

                        </div>
                    </div>
                    
                </div>

                <table class="table table-bordered " style="width: 100%; border: 1px solid #000;">
                    <thead>
                        <tr>
                            <th style="width: 10px"> No</th>
                            <th class="col-md-2">Tanggal</th>
                            <th class="col-md-2">Fee</th>
                            <th class="col-md-2">Nominal</th>
                            <th class="col-md-1">Admin</th>
                            <th class="col-md-0">TRX</th>
                            <th class="col-md-1">APP</th>
                            <th class="col-md-0">Metode</th>
                            <th class="col-md-2">Tax</th>
                            <th class="col-md-2">Tujuan</th>
                            <th class="col-md-1">Edit</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @if($data->count())
                        @foreach ($data as $index => $transaksi)
                            <tr style="height: 70px">
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y, H:i') }}</td>
                                <td class="txtFee" style="font-weight: bold">{{ strtoupper($transaksi->fee) }}</td>
                                <td>{{ ($transaksi->nominal) }}</td>
                                <td>{{ strtoupper($transaksi->admin) }}</td>
                                <td class="txtTrx" style="font-weight: bold">{{ strtoupper($transaksi->trx) }}</td>
                                <td>{{ ($transaksi->app) }}</td>
                                <td>{{ ($transaksi->metode) }}</td>
                                <td>{{ strtoupper($transaksi->tax) }}</td>
                                <td>{{ strtoupper($transaksi->tujuan) }}</td>
                                <td  >            
                                    <form action="/transaksi/{{$transaksi->id_transaksi}}" method="POST" style="display: none;"  class="delete-form" onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <img src="image/delete.png" style="width: 25px">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        
                    <tr>
                        <td colspan="2"><strong>Total:</strong></td>
                        <td style="font-weight: bold">{{$totalFeeRupiah}}</td>
                        <td style="font-weight: bold" >{{$totalNominalRupiah}}</td>
                        <td style="font-weight: bold">{{$totalAdminRupiah}}</td>
                        <td colspan="3"></td>
                       
                        <td style="font-weight: bold">{{$totalTaxRupiah}}</td>
                    </tr>
                    </tbody>
                </table>
              
           
                {{-- {!! $data->appends(\Request::except('page'))->render("pagination::bootstrap-4") !!} --}}

            </div>

    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>

    function printTable() {
            // Get the table element by its class name
            const table = document.querySelector(".table-bordered");

            // Get the current date for naming the file
            const currentDate = new Date();
            const day = String(currentDate.getDate()).padStart(2, "0");
            const month = String(currentDate.getMonth() + 1).padStart(2, "0");
            const year = currentDate.getFullYear();
            const formattedDate = `${day}/${month}/${year}`;

            // Open a new window for printing
            const printWindow = window.open("", "_blank");

             

            // Write the table HTML content to the new window
            printWindow.document.write('<html><head><title>e-Statement</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('.table-bordered { border-collapse: collapse; width: 100%; }');
            printWindow.document.write('.table-bordered th, .table-bordered td { border: 1px solid #000; padding: 8px; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(table.outerHTML);
            printWindow.document.write('</body></html>');

           // Close the document write to show the content
        printWindow.document.close();
          // Set the file name with the date
          printWindow.document.title = `e-Statement ${formattedDate}.pdf`;

        // Call the print function of the new window
        printWindow.print();

          

        }
   
   function changeColorFee(){
        // Menggunakan document.querySelectorAll untuk memilih semua elemen dengan kelas "txtFee"
        const textColorFee = document.querySelectorAll(".txtFee");
        const textColorTrx = document.querySelectorAll(".txtTrx");

        // Iterasi melalui setiap elemen
        textColorFee.forEach(function (textElement) {
            // Hapus kelas yang sudah ada sebelumnya (jika ada)
            textElement.classList.remove("red-text");
            textElement.classList.remove("green-text");

            // Tambahkan kelas warna berdasarkan kondisi
            if (textElement.textContent.includes("-")) {
                textElement.classList.add("red-text");
            } else {
                textElement.classList.add("green-text");
            }
        });

        // Iterasi melalui setiap elemen
        textColorTrx.forEach(function (textElement) {
            // Hapus kelas yang sudah ada sebelumnya (jika ada)
            textElement.classList.remove("red-text");
            textElement.classList.remove("green-text");
            textElement.classList.remove("blue-text");

            // Tambahkan kelas warna berdasarkan kondisi
            if (textElement.textContent.includes("DB")) {
                textElement.classList.add("red-text");
            } else if (textElement.textContent.includes("CR")){
                textElement.classList.add("green-text");
            } else{
                textElement.classList.add("blue-text");
            }
        });
   }


   
   function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
          title: 'Apakah Anda yakin ingin menghapus Transaksi ini?',
          text: "Data yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            event.target.submit();
          }
        })
      }

      function controllerDlt() {
        var editButton = document.getElementsByClassName("btnDlt")[0];
        if (editButton.innerHTML === "Edit") {
            editButton.innerHTML = "Cancel";
        } else {
            editButton.innerHTML = "Edit";
        }
        
        var deleteForms = document.getElementsByClassName("delete-form");
        for (var i = 0; i < deleteForms.length; i++) {
            var form = deleteForms[i];
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    }


       document.addEventListener("DOMContentLoaded", function () {
        changeColorFee();
        confirmDelete();
        showDeleteButton();
        hideDeleteButton();        
       
    });
</script>




</html>
