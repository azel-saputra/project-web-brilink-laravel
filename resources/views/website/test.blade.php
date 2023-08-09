<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
      
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

     

      
    </style>
</head>
<body class="bg-dark">
    <!--navbar-->
    <nav class="navbar navbar-inverse bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
            
                <a class="navbar-brand text-dark" href="#">CHIEN BRILink</a>
            </div>
        </div>
    </nav>

    <div class="d-flex" id="wrapper">
            <!--sidebar-->

        <div class="border-end p-1 bg-light " id="sidebar-wrapper" style="width: 200px; height:100vh ">
            <a class="h5 list-group-item list-group-item-action list-group-item-light p-3 border" href="{{route('dashboard')}}" style="text-align: center">Dashboard</a>
            <a class="h5 list-group-item list-group-item-action list-group-item-light p-3 border" href="{{route('transaksi')}}" style="text-align: center">Trancation</a>
            <a class="h5 list-group-item list-group-item-action list-group-item-light p-3 border" href="{{route('test')}}" style="text-align: center">Test Ui</a>

            <a class="h5 list-group-item list-group-item-action list-group-item-light p-3 border" href="{{route('report')}}" style="text-align: center">Report</a>

            <div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="h5 list-group-item list-group-item-action list-group-item-light p-3 border" style="text-align: center; color: red" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <img src="" style="width: 25px"> {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>

        <main class="container">   
            
        </main>

    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
   
   function changeColorFee(){
        // Menggunakan document.querySelectorAll untuk memilih semua elemen dengan kelas "txtFee"
        const textElements = document.querySelectorAll(".txtFee");

        // Iterasi melalui setiap elemen
        textElements.forEach(function (textElement) {
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
   }
       document.addEventListener("DOMContentLoaded", function () {
        changeColorFee();
    });
</script>
</html>
