<?php

require "auth.php";

session_start();

$mobilid = $_GET["id"];
$jenis = $_GET["jenis"];

$mobil = new MobilMatic($conn);
if ($jenis == "kopling")
{
    $mobil = new MobilKopling($conn);
}
$mobil->getDataById($mobilid);

require "loggedin.php";

if (isset($_POST["rent"]))
{
    $rental = new Rental($conn);
    $rental->id_customer = $customer->id;
    $rental->tanggal = $_POST["tanggalrental"];
    $rental->durasi = intval($_POST["durasi"]);
    $rental->harga = intval($_POST["totalharga"]);
    $rental->jenis = $jenis;
    $rental->id_barang = intval($_POST["id_barang"]);
    $rental->uniqueid = strval(rand(0,9999999));
    $rental->status = StatusRental::$menunggu_bukti_pembayaran;
    $rental->insertRental();

    $mp = new MetodePembayaran($conn);
    $data = $mp->selectAll();
    $namamp = "";

    while ($d = $data->fetch_assoc())
    {
        if ($_POST[$d["nama"]."_x"] != null)
        {
            $namamp = $d["nama"];
            break;
        }
    }

    $buktipembayaran = new BuktiPembayaran($conn);
    $buktipembayaran->id_customer = $customer->id;
    $buktipembayaran->uniqueid = $rental->uniqueid;
    $buktipembayaran->metode = $namamp;
    $buktipembayaran->insertBuktiPembayaran();

    header("Location: metode.php?nama=$namamp&uid=".$rental->uniqueid);
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
        <?php require 'navbar-loggedin.php'; ?>

        <div class="bgdiv-truck pb-3">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
        </div>

        <div class="gradient-light-blue p-3">
        </div>

        <div class="container mb-3">
            <h3><?php echo $mobil->nama; ?></h3>
            <div class="row">
                <div class="col">
                    <img src="foto_mobil/<?php echo $mobil->foto; ?>" class="pt-5 mx-auto d-block" style="width:auto; height:300px;">
                </div>
                <div class="col">
                    <p>Merk : <?php echo $mobil->merk; ?></p>
                    <p>No.Polisi : <?php echo $mobil->nopolisi; ?></p>
                    <p>Pricelist :</p>
                    <p>Rp <?php echo $mobil->harga12jam; ?>/12 jam</p>
                    <p>Rp <?php echo $mobil->harga24jam; ?>/24 jam</p>
                </div>
                <div class="col">
                    <label for="tglrental">Tanggal Rental :</label>
                    <input type="date" id="tglrental" name="tglrental">
                    <div class="form-check">
                        <input checked class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="rb12jam form-check-label" for="flexRadioDefault1">
                            12 Jam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="rb24jam form-check-label" for="flexRadioDefault2">
                            24 Jam
                        </label>
                    </div>
                    <form method="post">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Tanggal Rental</td>
                                    <td id="tanggaltd">11 Maret 2020</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td id="durasi">12 Jam</td>
                                </tr>
                                <tr>
                                    <td>Total Harga Rental</td>
                                    <td id="totalharga">Rp.<?php echo $mobil->harga12jam; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" name="rent" class="btnn bg-redp" data-toggle="modal" data-target="#exampleModal">Rent Now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post">
                        <input id="f_idacc" type="hidden" name="idacc" value="<?php echo $customer->id; ?>">
                        <input id="f_tanggalrental" type="hidden" name="tanggalrental" value="">
                        <input id="f_durasi" type="hidden" name="durasi" value="12">
                        <input id="f_totalharga" type="hidden" name="totalharga" value="<?php echo $mobil->harga12jam; ?>">
                        <input id="f_idbarang" type="hidden" name="id_barang" value="<?php echo $mobil->id; ?>">
                        <input id="f_rent" type="hidden" name="rent" value="">

                        <?php 
                            $mp = new MetodePembayaran($conn);
                            $data = $mp->selectAll();
                            while ($d = $data->fetch_assoc())
                            {
                                echo '<input type="image" name="'.$d["nama"].'" src="foto_mp/'.$d["foto"].'" width="200px" height="auto">';
                            }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Rent Now</button> -->
                </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
        <script>
        function padLeadingZeros(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }

        function inputDateToStringDate(val)
        {
            let year = val.substr(0,4);
            let month = parseInt(val.substr(5,2))-1;
            let date = val.substr(8,2);

            return date + " " + namaBulan[month] + " " + year
        }
        let namaBulan = [
            "Januari","Februari","Maret","April","May","Juni","Juli","Agustus","September","October","November","Desember"
        ]
        let nowDate = new Date();
        $('#tglrental').val(
            nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2)
            );
        
        $("#f_tanggalrental").val(nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2))
        $("#tanggaltd").html(inputDateToStringDate($('#tglrental').val()))
        $("#tglrental").change(function()
        {
            $("#f_tanggalrental").val(nowDate.getFullYear()+"-"+padLeadingZeros(nowDate.getMonth()+1,2)+"-"+padLeadingZeros(nowDate.getDate(),2))
            $("#tanggaltd").html(inputDateToStringDate($('#tglrental').val()))
        })

        $(".rb12jam").click(function()
        {
            $("#f_durasi").val(12)
            $("#durasi").html("12 Jam");
            $("#totalharga").html("Rp.<?php echo $mobil->harga12jam; ?>")
            $("#f_totalharga").val("<?php echo $mobil->harga12jam; ?>")
        })

        $(".rb24jam").click(function()
        {
            $("#f_durasi").val(24)
            $("#durasi").html("24 Jam");
            $("#totalharga").html("Rp.<?php echo $mobil->harga24jam; ?>")
            $("#f_totalharga").val("<?php echo $mobil->harga24jam; ?>")
        })
        </script>
    </body>
</html>