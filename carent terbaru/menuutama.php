<?php

require "auth.php";

session_start();

require "loggedin.php";

require "notadminplace.php";
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
            <h3 class="text-center pt-2" style="font-style:italic;">Pilih mobilmu nikmati perjalanannya!</h3>
        </div>

        <div class="gradient-light-blue p-3">
        </div>

        <div class="mt-3 mb-3">
            <div class="container">
                <h3>Mobil Matic</h3>
                <div class="row">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM mobilmatic");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows == 0)
                    {
                        echo '<p>Data kosong, silahkan admin untuk mengisi</p>';
                    }
                    while ($d = $res->fetch_assoc())
                    {
                        $mobil = new MobilMatic($conn);
                        $mobil->getDataById($d["id"]);
                        echo '<div class="col m-3">
                        <div class="card shadow mx-auto d-block" style="width: 18rem;">
                            <img class="card-img-top p-3" src="foto_mobil/'.$mobil->foto.'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$mobil->nama.'</h5>
                            </div>
                            <div class="card-footer bg-transparent pb-3 pt-3">
                                <a href="rental.php?id='.$mobil->id.'&jenis=matic" class="btnn bg-redp text-white">Rent Now</a>
                                <button type="button" class="btnn bg-blacknot text-white" data-toggle="modal" data-target="#datamobil_'.$mobil->id.'">Detail</button>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
                    
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="container">
                <h3>Mobil Kopling</h3>
                <div class="row">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM mobilkopling");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows == 0)
                    {
                        echo '<p>Data kosong, silahkan admin untuk mengisi</p>';
                    }
                    while ($d = $res->fetch_assoc())
                    {
                        $mobil = new MobilKopling($conn);
                        $mobil->getDataById($d["id"]);
                        echo '<div class="col m-3">
                        <div class="card shadow mx-auto d-block" style="width: 18rem;">
                            <img class="card-img-top p-3" src="foto_mobil/'.$mobil->foto.'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$mobil->nama.'</h5>
                            </div>
                            <div class="card-footer bg-transparent pb-3 pt-3">
                                <a href="rental.php?id='.$mobil->id.'&jenis=kopling" class="btnn bg-redp text-white">Rent Now</a>
                                <button type="button" class="btnn bg-blacknot text-white" data-toggle="modal" data-target="#kopdatamobil_'.$mobil->id.'">Detail</button>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
                    
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="container">
                <h3>Paket Matic</h3>
                <div class="row">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM paketmatic");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows == 0)
                    {
                        echo '<p>Data kosong, silahkan admin untuk mengisi</p>';
                    }
                    while ($d = $res->fetch_assoc())
                    {
                        $paket = new PaketMatic($conn);
                        $paket->getDataById($d["id"]);
                        echo '<div class="col m-3">
                        <div class="card shadow mx-auto d-block" style="width: 18rem;">
                            <img class="card-img-top p-3" src="foto_paket/'.$paket->foto.'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$paket->nama.'</h5>
                            </div>
                            <div class="card-footer bg-transparent pb-3 pt-3">
                                <a href="rentalpaket.php?id='.$paket->id.'&jenis=paketmatic" class="btnn bg-redp text-white">Rent Now</a>
                                <button type="button" class="btnn bg-blacknot text-white" data-toggle="modal" data-target="#paketmaticdatamobil_'.$paket->id.'">Detail</button>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
                    
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="container">
                <h3>Paket Kopling</h3>
                <div class="row">
                <?php
                    $stmt = $conn->prepare("SELECT * FROM paketkopling");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows == 0)
                    {
                        echo '<p>Data kosong, silahkan admin untuk mengisi</p>';
                    }
                    while ($d = $res->fetch_assoc())
                    {
                        $paket = new paketkopling($conn);
                        $paket->getDataById($d["id"]);
                        echo '<div class="col m-3">
                        <div class="card shadow mx-auto d-block" style="width: 18rem;">
                            <img class="card-img-top p-3" src="foto_paket/'.$paket->foto.'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'.$paket->nama.'</h5>
                            </div>
                            <div class="card-footer bg-transparent pb-3 pt-3">
                                <a href="rentalpaket.php?id='.$paket->id.'&jenis=paketkopling" class="btnn bg-redp text-white">Rent Now</a>
                                <button type="button" class="btnn bg-blacknot text-white" data-toggle="modal" data-target="#paketkoplingdatamobil_'.$paket->id.'">Detail</button>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
                    
                </div>
            </div>
        </div>

        <?php
            $stmt = $conn->prepare("SELECT * FROM mobilmatic");
            $stmt->execute();
            $res = $stmt->get_result();
            while ($d = $res->fetch_assoc())
            {
                $mobil = new MobilMatic($conn);
                $mobil->getDataById($d["id"]);
                echo '<div class="modal fade" id="datamobil_'.$mobil->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>'.$mobil->nama.'</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>'.$mobil->nopolisi.'</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>'.$mobil->merk.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>';
            }

            $stmt = $conn->prepare("SELECT * FROM mobilkopling");
            $stmt->execute();
            $res = $stmt->get_result();
            while ($d = $res->fetch_assoc())
            {
                $mobil = new MobilKopling($conn);
                $mobil->getDataById($d["id"]);
                echo '<div class="modal fade" id="kopdatamobil_'.$mobil->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>'.$mobil->nama.'</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>'.$mobil->nopolisi.'</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>'.$mobil->merk.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>';
            }

            $stmt = $conn->prepare("SELECT * FROM paketmatic");
            $stmt->execute();
            $res = $stmt->get_result();
            while ($d = $res->fetch_assoc())
            {
                $paket = new PaketMatic($conn);
                $paket->getDataById($d["id"]);
                $supir = new Supir($conn);
                $supir->getDataById($paket->id_supir);
                $mobil = new MobilMatic($conn);
                $mobil->getDataById($paket->id_mobil);
                echo '<div class="modal fade" id="paketmaticdatamobil_'.$paket->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama Paket</td>
                                    <td>'.$paket->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Nama Mobil</td>
                                    <td>'.$mobil->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Merk Mobil</td>
                                    <td>'.$mobil->merk.'</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>'.$mobil->nopolisi.'</td>
                                </tr>
                                <tr>
                                    <td>Supir</td>
                                    <td>'.$supir->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>'.$paket->durasi.' Jam</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>Rp. '.$paket->harga.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>';
            }

            $stmt = $conn->prepare("SELECT * FROM paketkopling");
            $stmt->execute();
            $res = $stmt->get_result();
            while ($d = $res->fetch_assoc())
            {
                $paket = new PaketKopling($conn);
                $paket->getDataById($d["id"]);
                $supir = new Supir($conn);
                $supir->getDataById($paket->id_supir);
                $mobil = new MobilKopling($conn);
                $mobil->getDataById($paket->id_mobil);
                echo '<div class="modal fade" id="paketkoplingdatamobil_'.$paket->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama Paket</td>
                                    <td>'.$paket->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Nama Mobil</td>
                                    <td>'.$mobil->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Merk Mobil</td>
                                    <td>'.$mobil->merk.'</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>'.$mobil->nopolisi.'</td>
                                </tr>
                                <tr>
                                    <td>Supir</td>
                                    <td>'.$supir->nama.'</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>'.$paket->durasi.' Jam</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>Rp. '.$paket->harga.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>';
            }
                ?>

        <!-- Modal -->
        

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
    </body>
</html>