<?php
require "auth.php";

session_start();

require "loggedin-admin.php";

if (isset($_POST["tambah"]))
{
    $mp = new MetodePembayaran($conn);
    $mp->nama = $_POST["nama"];
    $mp->norek = $_POST["norek"];
    $mp->atasnama = $_POST["atasnama"];
    $mp->uploadFoto($_FILES["foto"]);
    $mp->insertMetodePembayaran();

    header("Location: metodepembayaranadmin.php");
    exit;
}

if (isset($_POST["hapus"]))
{
    $mp = new MetodePembayaran($conn);
    $mp->id = $_POST["hapus"];
    $mp->deleteMetodePembayaran();

    header("Location: metodepembayaranadmin.php");
    exit;
}

if (isset($_POST["edit"]))
{
    $mp = new MetodePembayaran($conn);
    $mp->getDataById($_POST["edit"]);
    $mp->id = $_POST["edit"];
    $mp->nama = $_POST["nama"];
    $mp->norek = $_POST["norek"];
    $mp->atasnama = $_POST["atasnama"];
    
    if ($_FILES["foto"]["name"] != null)
    {
        $mp->uploadFoto($_FILES["foto"]);
    }
    $mp->updateMetodePembayaran();

    header("Location: metodepembayaranadmin.php");
    exit;
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
        <?php require 'navbar-admin-loggedin.php'; ?>
        <div class="bgdiv-truck" style="height:100vh;">
            
            <div class="row h-100" id="menulol" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0 pt-5 pb-5">
                    <?php
                        $metodepembayaranadmin = "font-weight-bold";
                        require "adminmenu.php";
                    ?>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4"></h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Metode Pembayaran</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No Rek</th>
                            <th scope="col">Atas Nama</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM metodepembayaran");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $mp = new MetodePembayaran($conn);
                                $mp->getDataById($d["id"]);
                                echo '
                                <input type="hidden" id="nama_'.$mp->id.'" value="'.$mp->nama.'">
                                <input type="hidden" id="norek_'.$mp->id.'" value="'.$mp->norek.'">
                                <input type="hidden" id="atasnama_'.$mp->id.'" value="'.$mp->atasnama.'">
                                <input type="hidden" id="foto_'.$mp->id.'" value="'.$mp->foto.'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$mp->nama.'</td>
                                <td>'.$mp->norek.'</td>
                                <td>'.$mp->atasnama.'</td>
                                <td><img src="foto_mp/'.$mp->foto.'" width="100px"></td>
                                <td>
                                <form method="post">
                                    <button mpid="'.$mp->id.'" type="button" class="editMetodePembayanBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModal">Edit</button>
                                    <button type="submit" name="hapus" value="'.$mp->id.'" class="btn btn-danger">Delete</button></form>
                                </td>
                            </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Mobil -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Metode Pembayaran</h5>
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
                            <input required name="norek" style="height:50px;border:none;" placeholder="Nomor Rekening" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="atasnama" style="height:50px;border:none;" placeholder="Atas Nama" type="text" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Metode Pembayaran</p>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Metode Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="jenis" id="editmobiljenis" value="matic">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editnama" name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editnorek" required name="norek" style="height:50px;border:none;" placeholder="No Rekening" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editatasnama" required name="atasnama" style="height:50px;border:none;" placeholder="Atas Nama" type="text" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Metode Pembayaran</p>
                        <input name="foto" id="myfotomobil" type="file"><br><br>
                        <img src="foto_mp/" id="editfoto" height="100" width="auto">
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
        $(".editMetodePembayanBtn").click(function(e)
        {
            let mpid = $(e.currentTarget).attr("mpid");
            $("#editnama").val($("#nama_"+mpid).val())
            $("#editnorek").val($("#norek_"+mpid).val())
            $("#editatasnama").val($("#atasnama_"+mpid).val())
            $("#editfoto").attr("src","foto_mp/"+$("#foto_"+mpid).val())
            $("#editbtn").val(mpid);
        })
        </script>
    </body>
</html>