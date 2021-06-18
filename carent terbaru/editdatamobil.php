<?php
require "auth.php";

session_start();

require "loggedin-admin.php";

if (isset($_POST["tambah"]))
{
    $mm = new MobilMatic($conn);
    if ($_POST["jenis"] == "kopling")
    {
        $mm = new MobilKopling($conn);
    }
    $mm->nama = $_POST["nama"];
    $mm->nopolisi = $_POST["nopolisi"];
    $mm->merk = $_POST["merk"];
    $mm->harga12jam = intval($_POST["hargarental12jam"]);
    $mm->harga24jam = intval($_POST["hargarental24jam"]);
    $mm->uploadFoto($_FILES["foto"]);

    $mm->insertMobil();

    header("Location: editdatamobil.php");
    exit;
}

if (isset($_POST["hapus"]))
{
    $mm = new MobilMatic($conn);
    if ($_POST["jenis"] == "kopling")
    {
        $mm = new MobilKopling($conn);
    }
    $mm->id = $_POST["hapus"];
    $mm->deleteMobil();

    header("Location: editdatamobil.php");
    exit;
}

if (isset($_POST["edit"]))
{
    $mm = new MobilMatic($conn);
    if ($_POST["jenis"] == "kopling")
    {
        $mm = new MobilKopling($conn);
    }
    $mm->getDataById($_POST["edit"]);
    $mm->id = $_POST["edit"];
    $mm->nama = $_POST["nama"];
    $mm->nopolisi = $_POST["nopolisi"];
    $mm->merk = $_POST["merk"];
    $mm->harga12jam = intval($_POST["hargarental12jam"]);
    $mm->harga24jam = intval($_POST["hargarental24jam"]);
    if ($_FILES["foto"]["name"] != null)
    {
        $mm->uploadFoto($_FILES["foto"]);
    }

    $mm->updateMobil();

    header("Location: editdatamobil.php");
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
        <div class="bgdiv-truck" style="height:100%;">
            
            <div class="row" id="menulol" style="width:99vw;min-height:100vh;">
                <div class="col-2 bg-lightblue p-0 pt-5 pb-5">
                    
                    <?php
                        $editdatamobil = "font-weight-bold";
                        require "adminmenu.php";
                    ?>

                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Mobil Matic</h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mobil</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Harga Rental 12 Jam</th>
                            <th scope="col">Harga Rental 24 Jam</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM mobilmatic");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $mobil = new MobilMatic($conn);
                                $mobil->getDataById($d["id"]);
                                echo '
                                <input type="hidden" id="nama_'.$mobil->id.'" value="'.$mobil->nama.'">
                                <input type="hidden" id="nopolisi_'.$mobil->id.'" value="'.$mobil->nopolisi.'">
                                <input type="hidden" id="merk_'.$mobil->id.'" value="'.$mobil->merk.'">
                                <input type="hidden" id="foto_'.$mobil->id.'" value="'.$mobil->foto.'">
                                <input type="hidden" id="hargarental12jam_'.$mobil->id.'" value="'.$mobil->harga12jam.'">
                                <input type="hidden" id="hargarental24jam_'.$mobil->id.'" value="'.$mobil->harga24jam.'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$mobil->nama.'</td>
                                <td>'.$mobil->nopolisi.'</td>
                                <td>'.$mobil->merk.'</td>
                                <td>Rp '.$mobil->harga12jam.'</td>
                                <td>Rp '.$mobil->harga24jam.'</td>
                                <td>
                                <form method="post">
                                    <input type="hidden" name="jenis" value="matic">
                                    <button mobilId="'.$mobil->id.'" jenis="matic" type="button" class="editMobilBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModalMatic">Edit</button>
                                    <button type="submit" name="hapus" value="'.$mobil->id.'" class="btn btn-danger">Delete</button></form>
                                </td>
                            </tr>';
                            }
                        ?>
                        </tbody>
                    </table>

                    <h3 class="mt-4 mb-4">Mobil Kopling</h3>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg-kop">Tambah Mobil</button>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Harga Rental 12 Jam</th>
                            <th scope="col">Harga Rental 24 Jam</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM mobilkopling");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $i = 0;
                            while ($d = $res->fetch_assoc())
                            {
                                $i++;
                                $mobil = new MobilKopling($conn);
                                $mobil->getDataById($d["id"]);
                                echo '
                                <input type="hidden" id="kopnama_'.$mobil->id.'" value="'.$mobil->nama.'">
                                <input type="hidden" id="kopnopolisi_'.$mobil->id.'" value="'.$mobil->nopolisi.'">
                                <input type="hidden" id="kopmerk_'.$mobil->id.'" value="'.$mobil->merk.'">
                                <input type="hidden" id="kopfoto_'.$mobil->id.'" value="'.$mobil->foto.'">
                                <input type="hidden" id="kophargarental12jam_'.$mobil->id.'" value="'.$mobil->harga12jam.'">
                                <input type="hidden" id="kophargarental24jam_'.$mobil->id.'" value="'.$mobil->harga24jam.'">
                                <tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$mobil->nama.'</td>
                                <td>'.$mobil->nopolisi.'</td>
                                <td>'.$mobil->merk.'</td>
                                <td>Rp '.$mobil->harga12jam.'</td>
                                <td>Rp '.$mobil->harga24jam.'</td>
                                <td>
                                <form method="post">
                                    <input type="hidden" name="jenis" value="kopling">
                                    <button mobilId="'.$mobil->id.'" jenis="kopling" type="button" class="editMobilBtn btn btn-warning" data-toggle="modal" data-target=".editMobilModal">Edit</button>
                                    <button type="submit" name="hapus" value="'.$mobil->id.'" class="btn btn-danger">Delete</button></form>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil</h5>
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
                            <input required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
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

        <!-- Modal Tambah Mobil Kopling -->
        <div class="modal fade bd-example-modal-lg-kop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil Kopling</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="jenis" value="kopling">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Mobil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="jenis" id="editmobiljenis" value="matic">
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="kopeditnama" name="nama" style="height:50px;border:none;" placeholder="Nama" type="text" class="form-control rounded-25" required>
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="kopeditnopolisi" required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="kopeditmerk" required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="kopedithargarental12jam" required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="kopedithargarental24jam" required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
                        <input name="foto" id="myfotomobil" type="file"><br><br>
                        <img src="foto_mobil/" id="kopeditfoto" height="100" width="auto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="kopeditbtn" name="edit" value="0" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Mobil MATIC -->
        <div class="modal fade editMobilModalMatic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Mobil Matic</h5>
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
                            <input id="editnopolisi" required name="nopolisi" style="height:50px;border:none;" placeholder="Nomor polisi" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="editmerk" required name="merk" style="height:50px;border:none;" placeholder="Merk" type="text" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="edithargarental12jam" required name="hargarental12jam" style="height:50px;border:none;" placeholder="Harga Rental / 12 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <div class="input-group mb-3 bg-white rounded-25 shadow">
                            <input id="edithargarental24jam" required name="hargarental24jam" style="height:50px;border:none;" placeholder="Harga Rental / 24 Jam" type="number" class="form-control rounded-25">
                        </div>
                        <p class="font-weight-bold">Upload Foto Mobil</p>
                        <input name="foto" id="myfotomobil" type="file"><br><br>
                        <img src="foto_mobil/" id="editfoto" height="100" width="auto">
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
        $(".editMobilBtn").click(function(e)
        {
            let mobilid = $(e.currentTarget).attr("mobilId");
            let jenis =$(e.currentTarget).attr("jenis");
            let sw = "";
            console.log(jenis);
            $("#editmobiljenis").val("matic")
            if (jenis == "kopling")
            {
                $("#editmobiljenis").val("kopling")
                sw = "kop"
            }

            $("#"+sw+"editnama").val($("#"+sw+"nama_"+mobilid).val())
            $("#"+sw+"editnopolisi").val($("#"+sw+"nopolisi_"+mobilid).val())
            $("#"+sw+"editmerk").val($("#"+sw+"merk_"+mobilid).val())
            $("#"+sw+"editjenismobil").val($("#"+sw+"jenismobil_"+mobilid).val())
            $("#"+sw+"edithargarental12jam").val($("#"+sw+"hargarental12jam_"+mobilid).val())
            $("#"+sw+"edithargarental24jam").val($("#"+sw+"hargarental24jam_"+mobilid).val())
            $("#"+sw+"editfoto").attr("src","foto_mobil/"+$("#"+sw+"foto_"+mobilid).val())
            $("#"+sw+"editbtn").val(mobilid);
        })
        </script>
    </body>
</html>