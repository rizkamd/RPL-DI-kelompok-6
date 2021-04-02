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
            <h3>Honda Brio</h3>
            <div class="row">
                <div class="col">
                    <img src="img/Unit_Honda-009 1.png" class="pt-5 mx-auto d-block" style="width:auto; height:100%;">
                </div>
                <div class="col">
                    <p>Merk : Honda</p>
                    <p>Jenis : Matic</p>
                    <p>No.Polisi : D 4848 JKT</p>
                    <p>Pricelist :</p>
                    <p>Rp 150.000/12 jam</p>
                    <p>Rp 250.000/24 jam</p>
                </div>
                <div class="col">
                    <label for="tglrental">Tanggal Rental :</label>
                    <input type="date" id="tglrental" name="tglrental" value="2003-01-22">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            12 Jam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            24 Jam
                        </label>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Tanggal Rental</td>
                                <td>11 Maret 2020</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td>24 Jam</td>
                            </tr>
                            <tr>
                                <td>Tptal Harga Rental</td>
                                <td>Rp.250.000</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btnn bg-redp">Rent Now</button>
                </div>
            </div>
        </div>

        <div class="w-100 bg-primary">
            <p class="text-right">©2019-2021 Carent Penyedia Jasa Rental Mobil</p>
        </div>
    </body>
</html>