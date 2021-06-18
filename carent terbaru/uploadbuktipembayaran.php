<?php

require "auth.php";

session_start();

require "loggedin.php";

if (isset($_POST["hapus"]))
{
    $rental = new Rental($conn);
    $rental->deleteRentalByUniqueId($_POST["hapus"]);
    $bukti = new BuktiPembayaran($conn);
    $bukti->deleteBuktiByUniqueId($_POST["hapus"]);
}

if (isset($_POST["kirimbukti"]))
{
    $bukti = new BuktiPembayaran($conn);
    $bukti->getDataByUniqueId($_POST["kirimbukti"]);
    $bukti->uploadFoto($_FILES["foto"]);
    $bukti->updateBuktiByUniqueId($_POST["kirimbukti"]);
    $ren = new Rental($conn);
    $ren->setStatusByUniqueId(StatusRental::$menunggu_bukti_pembayaran_diterima,$_POST["kirimbukti"]);
    header("Location:uploadbuktipembayaran.php");
}

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

        <div class="bgdiv-truck" style="height:123vh;">
            
            <div class="row" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0" style="height:123vh;">
                    <a href="editprofil.php" class="btn bg-lightblue text-dark w-100 m-0">Edit Profil</a>
                    <a href="uploadbuktipembayaran.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Upload Bukti Pembayaran</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Data</h3>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $q = $conn->query("SELECT * FROM rental WHERE id_customer = ".$customer->id);
                                $i = 0;
                                while ($d = $q->fetch_assoc())
                                {
                                    $i++;
                                    if (
                                        $d["status"] == StatusRental::$menunggu_bukti_pembayaran || 
                                        $d["status"] == StatusRental::$bukti_pembayaran_ditolak  || 
                                        $d["status"] == StatusRental::$bukti_pembayaran_diterima
                                        )
                                    {
                                        
                                    }else
                                    {
                                        continue;
                                    }

                                    if ($d["jenis"] == JenisBarang::$kopling)
                                    {
                                        $getmobil = $conn->query("SELECT * FROM mobilkopling WHERE id = ".$d["id_barang"]);
                                        $mobil = new MobilKopling($conn);
                                        $mobil->getDataById($d["id_barang"]);
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$mobil->nama.'</td>
                                        <td>'.$d["tanggal"].'</td>
                                        <td>Rp. '.$d["harga"].'</td>
                                        <td>'.$d["durasi"].' Jam</td>
                                        <td>';
                                        
                                        if ($d["status"] == StatusRental::$menunggu_bukti_pembayaran)
                                        {
                                            echo '<form method="post">
                                                <button type="button" uid="'.$d["uniqueid"].'" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary buktibayar">Upload Bukti Bayar</button>
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Batal</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_ditolak)
                                        {
                                            echo '<p>Bukti Pembayaran anda ditolak admin</p>
                                            <form method="post">
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Hapus</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_diterima)
                                        {
                                            echo '<p>Bukti Pembayaran anda diterima admin</p>';
                                        }

                                        echo '</td>
                                    </tr>';
                                    }
                                    
                                    if ($d["jenis"] == JenisBarang::$matic)
                                    {
                                        $getmobil = $conn->query("SELECT * FROM mobilkopling WHERE id = ".$d["id_barang"]);
                                        $mobil = new MobilMatic($conn);
                                        $mobil->getDataById($d["id_barang"]);
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$mobil->nama.'</td>
                                        <td>'.$d["tanggal"].'</td>
                                        <td>Rp. '.$d["harga"].'</td>
                                        <td>'.$d["durasi"].' Jam</td>
                                        <td>';
                                        
                                        if ($d["status"] == StatusRental::$menunggu_bukti_pembayaran)
                                        {
                                            echo '<form method="post">
                                                <button type="button" uid="'.$d["uniqueid"].'" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary buktibayar">Upload Bukti Bayar</button>
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Batal</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_ditolak)
                                        {
                                            echo '<p>Bukti Pembayaran anda ditolak admin</p>
                                            <form method="post">
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Hapus</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_diterima)
                                        {
                                            echo '<p>Bukti Pembayaran anda diterima admin</p>';
                                        }

                                        echo '</td>
                                    </tr>';
                                    }
                                    if ($d["jenis"] == JenisBarang::$paketmatic)
                                    {
                                        $getmobil = $conn->query("SELECT * FROM paketmatic WHERE id = ".$d["id_barang"]);
                                        $paket = new PaketMatic($conn);
                                        $paket->getDataById($d["id_barang"]);
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$paket->nama.'</td>
                                        <td>'.$d["tanggal"].'</td>
                                        <td>Rp. '.$d["harga"].'</td>
                                        <td>'.$d["durasi"].' Jam</td>
                                        <td>';
                                        
                                        if ($d["status"] == StatusRental::$menunggu_bukti_pembayaran)
                                        {
                                            echo '<form method="post">
                                                <button type="button" uid="'.$d["uniqueid"].'" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary buktibayar">Upload Bukti Bayar</button>
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Batal</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_ditolak)
                                        {
                                            echo '<p>Bukti Pembayaran anda ditolak admin</p>
                                            <form method="post">
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Hapus</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_diterima)
                                        {
                                            echo '<p>Bukti Pembayaran anda diterima admin</p>';
                                        }

                                        echo '</td>
                                    </tr>';
                                    }
                                    if ($d["jenis"] == JenisBarang::$paketkopling)
                                    {
                                        $getmobil = $conn->query("SELECT * FROM paketkopling WHERE id = ".$d["id_barang"]);
                                        $paket = new PaketKopling($conn);
                                        $paket->getDataById($d["id_barang"]);
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$paket->nama.'</td>
                                        <td>'.$d["tanggal"].'</td>
                                        <td>Rp. '.$d["harga"].'</td>
                                        <td>'.$d["durasi"].'-Jam</td>
                                        <td>';
                                        
                                        if ($d["status"] == StatusRental::$menunggu_bukti_pembayaran)
                                        {
                                            echo '<form method="post">
                                                <button type="button" uid="'.$d["uniqueid"].'" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary buktibayar">Upload Bukti Bayar</button>
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Batal</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_ditolak)
                                        {
                                            echo '<p>Bukti Pembayaran anda ditolak admin</p>
                                            <form method="post">
                                                <button type="submit" name="hapus" value="'.$d["uniqueid"].'"class="btn btn-danger">Hapus</button>
                                            </form>';
                                        }
                                        elseif ($d["status"] == StatusRental::$bukti_pembayaran_diterima)
                                        {
                                            echo '<p>Bukti Pembayaran anda diterima admin</p>';
                                        }

                                        echo '</td>
                                    </tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" enctype="multipart/form-data">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Foto</label>
                        <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="sendbukti" name="kirimbukti" value="" class="btn btn-primary">Kirim Bukti Bayar</button>
                </div>
                </div>
                </form>
            </div>
        </div>
        <script>
        $(".buktibayar").click(function(e){
            let uid = $(e.currentTarget).attr("uid");
            $("#sendbukti").val(uid);
        })
        </script>
    </body>
</html>