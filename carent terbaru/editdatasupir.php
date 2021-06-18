<?php
require "auth.php";

session_start();

require "loggedin-admin.php";

if (isset($_POST["tambah"]))
{
    $s = new Supir($conn);
    $s->nama = $_POST["nama"];
    $s->umur = $_POST["umur"];
    $s->kelamin = $_POST["kelamin"];
    $s->uploadFoto($_FILES["foto"]);
    $s->insertSupir();
    header("Location: editdatasupir.php");
}

if (isset($_POST["hapus"]))
{
    $s = new Supir($conn);
    $s->deleteSupir($_POST["hapus"]);
    header("Location: editdatasupir.php");
}

if (isset($_POST["edit"]))
{
    $s = new Supir($conn);
    $s->getDataById($_POST["edit"]);
    $s->id = $_POST["edit"];
    $s->nama = $_POST["nama"];
    $s->umur = $_POST["umur"];
    $s->kelamin = $_POST["kelamin"];
    
    if ($_FILES["foto"]["name"] != null)
    {
        $s->uploadFoto($_FILES["foto"]);
    }
    $s->updateSupir();
    header("Location: editdatasupir.php");
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
        <div class="bgdiv-truck" style="height:100vh;">
            
            <div class="row h-100" id="menulol" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0 pt-5 pb-5">
                    <?php
                        $editdatasupir = "font-weight-bold";
                        require "adminmenu.php";
                    ?>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4"></h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Supir</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Kelamin</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $allsupir = new Supir($conn);
                            $res = $allsupir->selectAll();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $supir = new Supir($conn);
                                $supir->getDataById($d["id"]);
                                echo '
                                <input type="hidden" id="nama_'.$supir->id.'" value="'.$supir->nama.'">
                                <input type="hidden" id="umur_'.$supir->id.'" value="'.$supir->umur.'">
                                <input type="hidden" id="kelamin_'.$supir->id.'" value="'.$supir->kelamin.'">
                                <input type="hidden" id="foto_'.$supir->id.'" value="'.$supir->foto.'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$supir->nama.'</td>
                                <td>'.$supir->umur.'</td>
                                <td>'.$supir->kelamin.'</td>
                                <td><img src="foto_supir/'.$supir->foto.'" width="100px"></td>
                                <td>
                                <form method="post">
                                    <button mpid="'.$supir->id.'" type="button" class="editSupirBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModal">Edit</button>
                                    <button type="submit" name="hapus" value="'.$supir->id.'" class="btn btn-danger">Delete</button></form>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Supir</h5>
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
                            <input required name="umur" style="height:50px;border:none;" placeholder="Umur" type="text" class="form-control rounded-25">
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kelamin</label>
                            </div>
                            <select name="kelamin" class="custom-select" id="inputGroupSelect01">
                                <option value="pria" selected>Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                        
                        <p class="font-weight-bold">Upload Foto Supir</p>
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
                            <input name="nama" id="editnama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required id="editumur" name="umur" style="height:50px;border:none;" placeholder="Umur" type="text" class="form-control rounded-25">
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kelamin</label>
                            </div>
                            <select name="kelamin" id="editkelamin" class="custom-select" id="inputGroupSelect01">
                                <option value="pria" selected>Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                        
                        <p class="font-weight-bold">Upload Foto Supir</p>
                        <input required name="foto" id="myfotomobil" type="file"><br>
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
        $(".editSupirBtn").click(function(e)
        {
            let mpid = $(e.currentTarget).attr("mpid");
            $("#editnama").val($("#nama_"+mpid).val())
            $("#editumur").val($("#umur_"+mpid).val())
            $("#editkelamin").val($("#kelamin_"+mpid).val())
            $("#editfoto").attr("src","foto_supir/"+$("#foto_"+mpid).val())
            $("#editbtn").val(mpid);
        })
        </script>
    </body>
</html>