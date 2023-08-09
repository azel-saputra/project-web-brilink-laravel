<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>


    <style>
        body {
            margin: 0;
            background-color: #35363a;
            color: #dadce0;
        }

        h1 {
            text-align: center;
        }

        .form {
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Gaya untuk container utama */
        .container-card {
            display: flex;
            gap: 20px; /* Jarak antara card */
            margin: 0 auto;
        }

        /* Gaya untuk setiap card */
        .card {
            flex: 1; /* Kartu akan berbagi lebar secara merata */
            border-radius: 5px;
            padding: 20px;
        }

        .card-header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Gaya untuk card pertama */
        .card-1 {
            /* Tambahkan gaya tambahan jika diperlukan */
        }

        /* Gaya untuk card kedua */
        .card-2 {
            height: 100%;
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

        .container-fluid{
                width: 200vh;
                margin: 100px;
            
            }

        @media (min-width: 2000px) and (min-height: 1200px) {
            .container-fluid{
                width: 200vh;
                margin: 100px;
            
            }
         
        }

        .sidebar{
            width: 300px
        }

        .total{
            height: 70px;
            text-align: center;
            background-color:#35363a ;
            display: flex; /* Membuat elemen menjadi flex container */
            align-items: center; /* Menyentuh elemen ke tengah secara vertikal */
            justify-content: center; /* Menyentuh elemen ke tengah secara horizontal */

        }

        #popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #202124;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            text-align: center;

        }      
        
          /* CSS styles for the buttons */
            #popup button {
                margin: 5px;
            }

 
            .input-container {
                display: flex;
                align-items: center;
            }

            .input-container label {
                margin-right: 10px;
            }

            .warning-image {
                width: 20px; /* Adjust the width of the image as needed */
                height: 20px; /* Adjust the height of the image as needed */
                margin-left: 10px;
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


            <div class="container-fluid my-4 ">
                @if (session('status'))
                <div id="alertContainer" class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif               

                <form class="form" method="POST" id="form" action="{{ route('transaksi_store') }}" onsubmit="return confirmSubmit(event)">
                    @csrf
            
                    <div class="container-card">
                        <!-- Card Pertama -->
                        <div class="card card-1">
                            <div class="card-header" style="text-align: center">Detail Transaksi</div>

                            <label for="created_at">Tanggal Dibuat: (MM/DD/YYYY)</label>
                            <input type="date" class="form-control mb-3 col-md-4" id="created_at" name="created_at" value="{{ date('Y-m-d') }}" required>

                            <label for="kategori">Kategori:</label>
                            <select class="col-md-4" name="kategori" id="kategori" required onchange="updateMetodeOptions()">
                                <option value="BRI">BRI</option>
                                <option value="Bank Lain">Bank Lain</option>
                            </select>
                
                            <label for="nominal">Nominal:</label>
                            <input type="text" name="nominal" id="nominal" oninput="calculateAdmin()" required>
                
                            
                
                            <label for="trx">TRX:</label>
                            <select class="col-md-4" name="trx" id="trx" onchange="calculateAdmin()" required>
                                <option value="">Pilih</option>
                                <option value="db">DB</option>
                                <option value="cr">CR</option>
                                <option value="mv">MV</option>
                            </select>
                
                            <label for="app">App:</label>
                            <select class="col-md-4" name="app" id="app" onchange="calculateAdmin()" required>
                                <option value="">Pilih</option>
                                <option value="BRILink">BRILink</option>
                                <option value="BRImo">BRImo</option>
                                <option value="BCA/BCA">BCA/BCA</option>
                                <option value="BCA/BRI">BCA/BRI</option>
                                <option value="BCA/BNI">BCA/BNI</option>
                                <option value="BCA/MDR">BCA/MDR</option>
                                <option value="BCA/PMX">BCA/PMX</option>
                                <option value="BCA/SB">BCA/SB</option>
                                <option value="BCA/###">BCA/###</option>
                                <option value="PMX/BCA">PMX/BCA</option>
                                <option value="PMX/BRI">PMX/BRI</option>
                                <option value="PMX/BNI">PMX/BNI</option>
                                <option value="PMX/MDR">PMX/MDR</option>
                                <option value="PMX/PMX">PMX/PMX</option>
                                <option value="PMX/SB">PMX/SB</option>
                                <option value="PMX/###">PMX/###</option>
                                <option value="SB/BCA">SB/BCA</option>
                                <option value="SB/BRI">SB/BRI</option>
                                <option value="SB/BNI">SB/BNI</option>
                                <option value="SB/MDR">SB/MDR</option>
                                <option value="SB/PMX">SB/PMX</option>
                                <option value="SB/SB">SB/SB</option>
                                <option value="SB/###">SB/###</option>
                                                                
                            </select>

                            <label for="metode">Metode:</label>
                            <select class="col-md-4" name="metode" id="metode"  onchange="calculateAdmin()" required>
                                <option value="">Pilih</option>
                                <option value="BI-FAST">BI-FAST</option>
                                <option value="ONLINE">ONLINE</option>
                                <option value="FREE/etc">FREE/etc</option>
                                <option value="BRIL/REG">BRIL/REG</option>
                                <option value="BRIL/PUL">BRIL/PUL</option>
                                <option value="BRIL/BILL">BRIL/BILL</option>
                                <option value="BRIL/KUR/etc">BRIL/KUR/etc</option>
                            </select>
                            
                            <label for="tujuan">Tujuan:</label>
                            <input type="text" name="tujuan" required>
                
                        </div>
                
                        <!-- Card Kedua -->
                        <div class="card card-2">
                            <div class="card-header" style="text-align: center">Total Transaksi</div>
                            <label for="total">Total:</label>
                            <h3 class="total" type="text" name="totall" id="total" step="0.01" readonly></h3>
                            <input class="total" type="text" name="total" id="totalInput" step="0.01" style="display: none;">
                
                            <label for="admin">Admin:</label>

                            <div class="input-container">
                                <input class="col-md-4" type="text" name="admin" id="admin" onchange="calculateAdmin()">
                                <img src="image/warning.png" class="warning-image" style="display: none;">
                            </div>
                
                            <label for="tax">Tax:</label>
                            <input class="col-md-4" style="background-color: #dadce0" type="text" name="tax" id="tax" step="0.01" readonly>
                
                            <label for="fee">Fee:</label>
                            <input class="col-md-4" style="background-color: #dadce0" type="text" name="fee" id="fee" step="0.01" readonly>
                            <br>

                            <input class="btn btn-submit bg-primary" style="color: #dadce0; font-weight: bold " type="submit" value="Submit" id="submitButton" onclick="return confirmInput();">

                
                        </div>

                    </div>
            
                </form>

                <div id="popup" style="display: none;">
                    <p id="message"></p>
                    <button onclick="closePopup()">Cancel</button>
                    <button onclick="confirmAndSubmit()">OK</button>
                  </div>
                  
            </div>


   

    <script>
    
        function formatNominal(){
            const hargaInput = document.querySelector('#nominal');
            const adminInput = document.querySelector('#admin');

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            hargaInput.addEventListener('input', function() {
                let harga = hargaInput.value;
                harga = harga.replace(/[^0-9]/g, ''); // hanya mengambil angka dari input
                if (harga === '') {
                    hargaInput.value = '';
                    return;
                } else{
                    harga = parseInt(harga, 10); // mengubah string menjadi integer
                    hargaInput.value = formatter.format(harga); // format nilai uang menjadi format rupiah
                }
            });

            adminInput.addEventListener('input', function() {
                let harga = adminInput.value;
                harga = harga.replace(/[^0-9]/g, ''); // hanya mengambil angka dari input
                if (harga === '') {
                    adminInput.value = '';
                    return;
                } else{
                    harga = parseInt(harga, 10); // mengubah string menjadi integer
                    adminInput.value = formatter.format(harga); // format nilai uang menjadi format rupiah
                }
            });
        }
    
         // Fungsi untuk mengubah angka menjadi format IDR
         function formatIDR(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0  // Menghilangkan dua angka di belakang koma
                }).format(number);
            }
    
        function parseIDRToNumber(idrValue) {
            // Hapus karakter yang tidak diperlukan, seperti 'IDR' dan tanda baca
            return parseFloat(idrValue.replace(/[^\d]/g, ''));
            return isNaN(numericValue) ? 0 : numericValue;

        }
    
        function calculateAdmin() {
    
            const nominalInput = document.getElementById('nominal');
            const adminInput = document.getElementById('admin');
            const taxInput = document.getElementById('tax');
            const metodeSelect = document.getElementById('metode');
            const feeInput = document.getElementById('fee');
            const totalInput = document.getElementById('total');
            const kategoriSelect = document.getElementById('kategori');
            const trxSelect = document.getElementById('trx');
            const inputHide = document.getElementById('totalInput');
            const warningImage = document.querySelector(".warning-image");


        
            const nominalValue = parseIDRToNumber(nominalInput.value);
            const adminChange = parseIDRToNumber(adminInput.value);
            const kategoriSelected = kategoriSelect.value
            const trxSelected = trxSelect.value

            // Jika nominalValue kosong, set nilai input nominal ke "Rp 0"
            if (nominalInput.value.trim() === '') {
                nominalInput.value = 'Rp 0';
            }
            
            let taxValue = 0;
                 
            if (kategoriSelected === 'BRI'){
                if(trxSelected === 'mv'){
                    adminValue = 0;
                } else{
                    // Logika untuk menghitung admin berdasarkan range nominal pada kategori brilink
                    if (nominalValue >= 10000 && nominalValue <= 1500000) {
                        adminValue = 5000;
                    } else if (nominalValue > 1500000 && nominalValue <= 3000000) {
                        adminValue = 10000;
                    } else if (nominalValue > 3000000 && nominalValue <= 5000000) {
                        adminValue = 15000;
                    } else if (nominalValue > 5000000 && nominalValue <= 8000000) {
                        adminValue = 25000;
                    }else if (nominalValue > 8000000 && nominalValue <= 12500000) {
                        adminValue = 30000;
                    }else if (nominalValue > 12500000 && nominalValue <= 17500000) {
                        adminValue = 35000;
                    }else if (nominalValue > 17500000 && nominalValue <= 22500000) {
                        adminValue = 40000;
                    }else if (nominalValue > 22500000 && nominalValue <= 27500000) {
                        adminValue = 45000;
                    }else if (nominalValue > 27500000 && nominalValue <= 32500000) {
                        adminValue = 50000;
                    }else {
                        adminValue = adminChange;
                        if(nominalValue > 32500000){
                            warningImage.style.display = "inline";
                        } else{
                            warningImage.style.display = "none";

                        }
                    }
                
                }
             
            } else if (kategoriSelected === 'Bank Lain'){
                if(trxSelected === 'mv'){
                    adminValue = 0;
                } else{
                    // Logika untuk menghitung admin berdasarkan range nominal pada kategori bank lain
                    if (nominalValue >= 25000 && nominalValue <= 2000000) {
                        adminValue = 10000;
                    } else if (nominalValue > 2000000 && nominalValue <= 4000000) {
                        adminValue = 15000;
                    } else if (nominalValue > 4000000 && nominalValue <= 6000000) {
                        adminValue = 20000;
                    } else if (nominalValue > 6000000 && nominalValue <= 8000000) {
                        adminValue = 25000;
                    }else if (nominalValue > 8000000 && nominalValue <= 10000000) {
                        adminValue = 30000;
                    }else if (nominalValue > 10000000 && nominalValue <= 12500000) {
                        adminValue = 35000;
                    }else if (nominalValue > 12500000 && nominalValue <= 15000000) {
                        adminValue = 40000;
                    }else if (nominalValue > 15000000 && nominalValue <= 17500000) {
                        adminValue = 45000;
                    }else if (nominalValue > 17500000 && nominalValue <= 20000000) {
                        adminValue = 50000;
                    }else {
                        adminValue = adminChange;
                        if(nominalValue > 20000000){
                            warningImage.style.display = "inline";
                        } else{
                            warningImage.style.display = "none";

                        }
                    }
                }
                
            }
        
            // Format adminInput jika adminValue adalah angka
            if (!isNaN(adminValue)) {
                const formatAdmin = formatIDR(adminValue);
                adminInput.value = formatAdmin;
            } else {
                // Jika adminValue bukan angka, set nilai input admin ke string kosong
                adminInput.value = 'Rp 0';
            }

            if (kategoriSelected === 'BRI'){
                // Kode untuk mengosongkan nilai admin jika nominal dikosongkan
                if (nominalValue >= 0 && nominalValue <= 9999) {
                    adminInput.value = 'Rp 0';
                }
            } else if (kategoriSelected === 'Bank Lain'){
                // Kode untuk mengosongkan nilai admin jika nominal dikosongkan
                if (nominalValue >= 0 && nominalValue <= 24999) {
                    adminInput.value = 'Rp 0';
                }
            }
                  

        
            // Logika untuk menghitung tax berdasarkan metode
            const selectedMetode = metodeSelect.value;
            if (selectedMetode === 'BI-FAST') {
                taxValue = 2500;
            } else if (selectedMetode === 'ONLINE') {
                taxValue = 6500;
            } else if (selectedMetode === 'FREE/etc') {
                taxValue = 0;
            } else if (selectedMetode === 'BRIL/REG') {
                taxValue = 3000;
            }else if (selectedMetode === 'BRIL/PUL') {
                taxValue = 2000;
            }else if (selectedMetode === 'BRIL/BILL') {
                taxValue = 3000;
            }else if (selectedMetode === 'BRIL/KUR/etc') {
                taxValue = 1000;
            }
        
            const feeFormat = formatIDR(taxValue);
            taxInput.value = feeFormat;
    


            //hitung FEE
            if (kategoriSelected === 'BRI'){
                // Hitung fee berdasarkan potongan admin yang telah dikurangi dari tax
                if (nominalValue <= 32500000) {
                    feeValue = adminValue - taxValue;
                } else {
                    feeValue = adminChange - taxValue;
                }
            } else if (kategoriSelected === 'Bank Lain'){
               // Hitung fee berdasarkan potongan admin yang telah dikurangi dari tax
               if (nominalValue <= 20000000) {
                    feeValue = adminValue - taxValue;
                } else {
                    feeValue = adminChange - taxValue;
                }
            }
    

            // Format feeInput jika feeValue adalah angka
            if (!isNaN(feeValue)) {
                const formattedFeeValue = formatIDR(feeValue);
                feeInput.value = formattedFeeValue;
            } else {
                // Jika feeValue bukan angka, set nilai input fee ke string kosong
                feeInput.value = 'Rp 0';
            }

             // Kode untuk mengosongkan nilai fee jika nominal dikosongkan
             if (kategoriSelected === 'BRI'){
                if (nominalValue >= 0 && nominalValue <= 9999) {
                    fee = adminValue - taxValue;
                    const formatedFee = formatIDR(fee);
                    feeInput.value = formatedFee;
            }
            } else if (kategoriSelected === 'Bank Lain'){
                if (nominalValue >= 0 && nominalValue <= 24999) {
                    fee = adminValue - taxValue;
                    const formatedFee = formatIDR(fee);
                    feeInput.value = formatedFee;            
                }
            }

    

            // Hitung total dengan menjumlahkan nilai nominal dan nilai admin
            if (adminInput > 0) {
                const totalValue = nominalValue + adminChange;
                if (!isNaN(totalValue) && isFinite(totalValue)) {
                    const formattedTotalValue = formatIDR(totalValue);
                    totalInput.innerText = formattedTotalValue;
                    inputHide.value = totalInput.innerText;

                } else {
                    // Jika totalValue bukan angka, set isi teks elemen h3 total ke "Rp 0"
                    totalInput.innerText = 'Rp 0';
                    inputHide.value = totalInput.innerText;

                }
            } else {
                const totalValue = nominalValue + adminValue;
                if (!isNaN(totalValue) && isFinite(totalValue)) {
                    const formattedTotalValue = formatIDR(totalValue);
                    totalInput.innerText = formattedTotalValue;
                    inputHide.value = totalInput.innerText;

                } else {
                    // Jika totalValue bukan angka, set isi teks elemen h3 total ke "Rp 0"
                    totalInput.innerText = 'Rp 0';
                    inputHide.value = totalInput.innerText;

                }
            }

                
                // Fungsi untuk memindahkan nilai dari h3 ke input
                function moveValueToInput() {
                    inputHide.value = totalInput.innerText;
                }
        }
    
        function updateMetodeOptions() {
            const kategoriSelect = document.getElementById('kategori');
            const metodeSelect = document.getElementById('metode');
            const appSelect = document.getElementById('app');
    
    
            // Ambil nilai kategori yang dipilih
            const selectedKategori = kategoriSelect.value;
    
             // Semua opsi pada 'appSelect' disembunyikan terlebih dahulu
            for (let i = 0; i < appSelect.options.length; i++) {
                appSelect.options[i].style.display = 'none';
            }
    
            // Jika kategori adalah 'brilink', tampilkan opsi 'brilink' dan 'brimobile' saja pada 'appSelect'
            if (selectedKategori === 'BRI') {
                for (let i = 0; i < appSelect.options.length; i++) {
                    const option = appSelect.options[i];
                    if (option.value === 'BRILink' || option.value === 'BRImo') {
                        option.style.display = 'block';
                    }
                }
            }
            // Jika kategori adalah 'bank lain', tampilkan semua opsi kecuali 'brilink' dan 'brimobile' pada 'appSelect'
            else if (selectedKategori === 'Bank Lain') {
                for (let i = 0; i < appSelect.options.length; i++) {
                    const option = appSelect.options[i];
                    if (option.value !== 'BRILink' && option.value !== 'BRImo') {
                        option.style.display = 'block';
                    }
                }
            }
    
            // Jika kategori adalah 'brilink', tampilkan semua opsi metode
            // Jika kategori adalah 'bank lain', sembunyikan opsi 'brilink' dari metode
            if (selectedKategori === 'BRI') {
                metodeSelect.options[4].style.display = 'block'; // Tampilkan opsi 'brilink'
                metodeSelect.options[5].style.display = 'block'; // Tampilkan opsi 'brilink'
                metodeSelect.options[6].style.display = 'block'; // Tampilkan opsi 'brilink'
                metodeSelect.options[7].style.display = 'block'; // Tampilkan opsi 'brilink'
        
            } else if (selectedKategori === 'Bank Lain') {
                metodeSelect.options[4].style.display = 'none'; // Sembunyikan opsi 'brilink'
                metodeSelect.options[5].style.display = 'none'; // Sembunyikan opsi 'brilink'
                metodeSelect.options[6].style.display = 'none'; // Sembunyikan opsi 'brilink'
                metodeSelect.options[7].style.display = 'none'; // Sembunyikan opsi 'brilink'
                if ((metodeSelect.value === 'BRIL/REG') || (metodeSelect.value === 'BRIL/KUR/etc') || (metodeSelect.value === 'BRIL/PUL') || (metodeSelect.value === 'BRIL/BILL')   ) {
                    metodeSelect.value = 'BI-FAST';
                    calculateAdmin(); // Hitung ulang admin dan tax
                }

    
            } 
            
        }

        function handleKeyPress(event) {
        if (event.keyCode === 13) {
            event.preventDefault(); // Mencegah form dari submit saat menekan tombol "Enter"
            completeAllFields();
        }
    }

    function completeAllFields() {
        // Mengambil semua elemen input dalam form
        const inputs = document.querySelectorAll('input');

        // Loop melalui semua input dan mengatur nilai attribute "value" untuk diisi dengan sesuatu
        inputs.forEach((input) => {
            // Tentukan nilai default yang akan diisi (misalnya '')
            const defaultValue = '';

            // Gunakan defaultValue sebagai nilai input (di-complete)
            input.value = defaultValue;
        });
    }

        // Cari elemen alert dengan id "alertContainer"
        var alertContainer = document.getElementById('alertContainer');

        // Fungsi untuk menyembunyikan alert setelah 5 detik
        function hideAlert() {
            alertContainer.style.display = 'none';
        }

        // Atur waktu 5 detik sebelum memanggil fungsi hideAlert
        setTimeout(hideAlert, 3000);

        function confirmInput() {
            const popup = document.getElementById("popup");
            const message = document.getElementById("message");

            message.textContent = "Apakah Anda yakin ingin menyimpan data pengguna?";
            popup.style.display = "block";

            return false; // Prevent form submission for this example
        }

        function closePopup() {
            const popup = document.getElementById("popup");
            popup.style.display = "none";
        }

        function confirmAndSubmit() {
            const popup = document.getElementById("popup");
            popup.style.display = "none";

            // Submit the form
            const form = document.getElementById("form"); // Replace "myForm" with your form ID
            form.submit();
        }

            

   
        
        // Panggil fungsi calculateAdmin() dan updateMetodeOptions() saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            calculateAdmin();
            updateMetodeOptions();
            formatNominal();
            formatIDR();
            handleKeyPress();
            completeAllFields();
            moveValueToInput();
            submitForm();
            hideAlert();
            confirmInput();
            closePopup();
        });
        </script>
</body>
</html>
