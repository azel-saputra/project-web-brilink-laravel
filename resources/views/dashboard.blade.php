<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <style>
        /* Basic styling for the sidebar and main content */
 
   

     //test

        /* Style the toggle button (you can use any icon library or your custom icon) */
        .toggle-button {
            position: fixed;
            top: 10px;
            left: 10px;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .counter-box {
            display: block;
            background: #f6f6f6;
            padding: 40px 20px 37px;
            width: 300px;
            text-align: center
            
        }   
        .heading-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card{
            background-color: #27282A;
            color: #dadce0; 
        }

        .card-fluid{
            margin-top: 20px;
            min-width: 260px;
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
            margin: 0;
        }

        .container-fluid{
                width: 200vh;
                margin: 100px;
            
            }

          

        /* CSS untuk layar handphone */
        @media screen and (max-width: 768px) {
        /* Tambahkan gaya CSS khusus untuk layar handphone di sini */
        /* Contoh: */
        .card-fluid{
            margin-bottom: 50px;  
        }
       
        }

        /* CSS untuk layar laptop */
        @media screen and (min-width: 769px) {
        /* Tambahkan gaya CSS khusus untuk layar laptop di sini */
        /* Contoh: */
/* 
        .card-fluid{
            margin-top: 50px;  
        } */

        .card-fluid{
            margin-bottom: 50px;  
        }
        
        }

        .sidebar{
            width:300px
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

        <div class="d-flex " id="wrapper">
                <!--sidebar-->

            <div class=" p-1 sidebar" id="sidebar-wrapper" style=" height:100vh ">
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


            
                <!-- Judul "Data Hari Ini" di atas Card -->
                <div class="container-fluid my-4 ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="py-4 heading-wrapper">
                                <h3 class="mb-0" style="color: #f1f1f1">Data Hari Ini</h3>
                                <h5 id="tanggal" class="mb-0 text-light"></h5> <!-- Tambahkan id "tanggal" ke elemen h5 -->
                            </div>
                        </div>
                    </div>
            

                <!-- Card View -->
                <div >
                    <div class="row">
                        <div class="col-md-3 card-fluid">
                            <div class="card" style="height: 120%">
                                <div class="card-header">
                                    Transaksi Hari Ini
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title" style="text-align: center">{{ ($transaksibaru) }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 card-fluid">
                            <div class="card" style="height: 120%">
                                <div class="card-header">
                                    Perputaran Uang
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Rp {{ number_format($totaltransaksibaru, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 card-fluid">
                            <div class="card" style="height: 120%">
                                <div class="card-header">
                                    Margin Admin
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Rp {{ number_format($totalmarginbaru, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 card-fluid" >
                            <div class="card" style="height: 120%">
                                <div class="card-header">
                                    Pendapatan Hari Ini
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Rp {{ number_format($totalpendapatanbaru, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        
    
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>

<script>
    // Skrip JavaScript untuk menampilkan tanggal saat ini di dalam elemen h5 dengan id "tanggal"
    const date = new Date();
    const day = String(date.getDate()).padStart(2, '0'); // Tambahkan '0' di depan jika hari memiliki satu digit
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Tambahkan '0' di depan jika bulan memiliki satu digit
    const year = date.getFullYear();
    document.getElementById('tanggal').innerText = `${day}/${month}/${year}`;    
 
</script>

</html>
