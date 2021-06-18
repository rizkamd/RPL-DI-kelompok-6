<?php

require "auth.php";

session_start();

//cek jika session belum login 
if (!isset($_SESSION["id"])) {
    header("Location: home.php");
    exit;
}

require "loggedin.php";
$mpData = new MetodePembayaran($conn);
$mpData->getDataByNama($_GET["nama"]);

$rentalData = new Rental($conn);
$rentalData->getDataByUniqueId($_GET["uid"]);

?>

<!DOCTYPE html>
<html>

<head>
    <title>CaRent</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <?php require 'navbar-loggedin.php'; ?>

    <div class="bgdiv-truck" style="height:62vh;">
        <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
        <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
        <h3 class="text-center pt-2" style="font-style:italic;">Mau cari rental mobil yang berkualitas?, Disini tempatnya, kualitas limosin harga cimin!</h3>
    </div>

    <div class="gradient-light-blue p-3">
    </div>

    <div class="pt-3">
        <h3 class="text-center font-weight-bold">Silahkan transfer dan upload bukti bayar</h3>
        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <!-- <tr>
                        <th>Nama</th>
                        <td><?php echo $_GET["nama"]; ?></td>
                    </tr> -->
                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?php echo $mpData->norek; ?></td>
                    </tr>
                    <tr>
                        <th>Atas Nama</th>
                        <td><?php echo $mpData->atasnama; ?></td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp. <?php echo $rentalData->harga; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="gradient-light-blue p-3">
    </div>

    <div class="bgdiv-truck" style="height:23vh;">
        <h1 class="text-center pt-5" style="font-style:italic;">Harga Cimin, Kualitas Limosin, Nyaman</h1>
    </div>

    <div class="w-100 bg-primary">
        <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
    </div>
</body>

</html>