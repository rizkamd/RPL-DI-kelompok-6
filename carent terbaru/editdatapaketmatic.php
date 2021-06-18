<?php
require "auth.php";

session_start();

require "loggedin-admin.php";

if (isset($_POST["tambah"]))
{
    $paket = new PaketMatic($conn);
    $paket->nama = $_POST["nama"];
    $paket->durasi = $_POST["durasi"];
    $paket->id_mobil = $_POST["id_mobil"];
    $paket->id_supir = $_POST["id_supir"];
    $paket->harga = $_POST["harga"];
    $paket->uploadFoto($_FILES["foto"]);
    $paket->insertPaketMatic();
    header("Location: editdatapaketmatic.php");
}

if (isset($_POST["hapus"]))
{
    $paket = new PaketMatic($conn);
    $paket->deletePaket($_POST["hapus"]);
    header("Location: editdatapaketmatic.php");
}

if (isset($_POST["edit"]))
{
    $paket = new PaketMatic($conn);
    $paket->getDataById($_POST["edit"]);
    $paket->id = $_POST["edit"];
    $paket->nama = $_POST["nama"];
    $paket->durasi = $_POST["durasi"];
    $paket->harga = $_POST["harga"];
    $paket->id_supir = $_POST["id_supir"];
    $paket->id_mobil = $_POST["id_mobil"];
    
    if ($_FILES["foto"]["name"] != null)
    {
        $paket->uploadFoto($_FILES["foto"]);
    }
    $paket->updatePaket();
    header("Location: editdatapaketmatic.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>CaRent</title>
        <link rel="stylesheet" href="css/main.css">
        <script src="jquery/jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="popper/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php require 'navbar-admin-loggedin.php'; ?>
        <div class="bgdiv-truck">
            
            <div class="row h-100" id="menulol" style="width:99vw;min-height:100vh;">
                <div class="col-2 bg-lightblue p-0 pt-5 pb-5">
                    <?php
                        $editdatapaketmatic = "font-weight-bold";
                        require "adminmenu.php";
                    ?>
                </div>
            
                <div class="col">

                    <h3 class="mt-4 mb-4">Paket Matic</h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Paket Matic</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $pk = new PaketMatic($conn);
                            $res = $pk->selectAll();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $paket = new PaketMatic($conn);
                                $paket->getDataById($d["id"]);
                                $mobil = new MobilMatic($conn);
                                $mobil->getDataById($paket->id_mobil);
                                $supir = new Supir($conn);
                                $supir->getDataById($paket->id_supir);
                                echo '
                                <input type="hidden" id="nama_'.$paket->id.'" value="'.$paket->nama.'">
                                <input type="hidden" id="idmobil_'.$paket->id.'" value="'.$paket->id_mobil.'">
                                <input type="hidden" id="durasi_'.$paket->id.'" value="'.$paket->durasi.'">
                                <input type="hidden" id="idsupir_'.$paket->id.'" value="'.$paket->id_supir.'">
                                <input type="hidden" id="foto_'.$paket->id.'" value="'.$paket->foto.'">
                                <input type="hidden" id="harga_'.$paket->id.'" value="'.$paket->harga.'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$paket->nama.'</td>
                                <td>'.$mobil->nama.'</td>
                                <td>'.$paket->durasi.' Jam</td>
                                <td>'.$supir->nama.'</td>
                                <td>'.$paket->harga.'</td>
                                <td><img src="foto_paket/'.$paket->foto.'" width="100px"></td>
                                <td>
                                <form method="post">
                                    <button mpid="'.$paket->id.'" type="button" class="editSupirBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModal">Edit</button>
                                    <button type="submit" name="hapus" value="'.$paket->id.'" class="btn btn-danger">Delete</button></form>
                                </td>
                            </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Supir -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Matic</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="jenis" value="matic">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="harga" style="height:50px;border:none;" placeholder="Harga" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Durasi</label>
                            </div>
                            <select name="durasi" class="custom-select" id="inputGroupSelect01">
                                <option value="12">12 Jam</option>
                                <option value="24">24 Jam</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Mobil</label>
                            </div>
                            <select name="id_mobil" class="custom-select" id="inputGroupSelect01">
                                <?php
                                    $mobil = new MobilMatic($conn);
                                    $res = $mobil->selectAll();
                                    while ($d = $res->fetch_assoc())
                                    {
                                        $_mobil = new MobilMatic($conn);
                                        $_mobil->getDataById($d["id"]);
                                        echo '<option value="'.$_mobil->id.'">'.$_mobil->nama.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Supir</label>
                            </div>
                            <select name="id_supir" class="custom-select" id="inputGroupSelect01">
                                <?php
                                    $sup = new Supir($conn);
                                    $res = $sup->selectAll();
                                    while ($d = $res->fetch_assoc())
                                    {
                                        $_sup = new Supir($conn);
                                        $_sup->getDataById($d["id"]);
                                        echo '<option value="'.$_sup->id.'">'.$_sup->nama.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <p class="font-weight-bold">Upload Foto Paket</p>
                        <input required name="foto" id="myfotomobil" type="file"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Mobil -->
        <div class="modal fade editMobilModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Paket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="jenis" id="editmobiljenis" value="matic">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input name="nama" id="editnama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required id="editharga" name="harga" style="height:50px;border:none;" placeholder="Harga" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Durasi</label>
                            </div>
                            <select name="durasi" id="editdurasi" class="custom-select" id="inputGroupSelect01">
                                <option value="12">12 Jam</option>
                                <option value="24">24 Jam</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Mobil</label>
                            </div>
                            <select name="id_mobil" id="editidmobil" class="custom-select" id="inputGroupSelect01">
                                <?php
                                    $mobil = new MobilMatic($conn);
                                    $res = $mobil->selectAll();
                                    while ($d = $res->fetch_assoc())
                                    {
                                        $_mobil = new MobilMatic($conn);
                                        $_mobil->getDataById($d["id"]);
                                        echo '<option value="'.$_mobil->id.'">'.$_mobil->nama.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Supir</label>
                            </div>
                            <select name="id_supir" id="editidsupir" class="custom-select" id="inputGroupSelect01">
                                <?php
                                    $sup = new Supir($conn);
                                    $res = $sup->selectAll();
                                    while ($d = $res->fetch_assoc())
                                    {
                                        $_sup = new Supir($conn);
                                        $_sup->getDataById($d["id"]);
                                        echo '<option value="'.$_sup->id.'">'.$_sup->nama.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <p class="font-weight-bold">Upload Foto Paket</p>
                        <input required name="foto" id="myfotomobil" type="file"><br>
                        <img src="foto_paket/" id="editfoto" height="100" width="auto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="editbtn" name="edit" value="0" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
        $(".editSupirBtn").click(function(e)
        {
            let mpid = $(e.currentTarget).attr("mpid");
            $("#editnama").val($("#nama_"+mpid).val())
            $("#editharga").val($("#harga_"+mpid).val())
            $("#editdurasi").val($("#durasi_"+mpid).val())
            $("#editidmobil").val($("#idmobil_"+mpid).val())
            $("#editidsupir").val($("#idsupir_"+mpid).val())
            $("#editfoto").attr("src","foto_paket/"+$("#foto_"+mpid).val())
            $("#editbtn").val(mpid);
        })
        </script>
    </body>
</html>