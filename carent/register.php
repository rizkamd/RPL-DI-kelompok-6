<!DOCTYPE html>
<html>
    <head>
        <title>CaRent</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php require 'navbar.php'; ?>

        <div class="bgdiv-truck">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:50px;">CaRent</h2>
            <div class="container p-3 w-50">
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <input style="height:50px;border:none;" placeholder="Nama Lengkap" type="text" class="form-control rounded-25">
                </div>
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <input style="height:50px;border:none;" placeholder="Alamat" type="text" class="form-control rounded-25">
                </div>
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <input style="height:50px;border:none;" placeholder="Username" type="text" class="form-control rounded-25">
                </div>
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <input style="height:50px;border:none;" placeholder="Password" type="password" class="form-control rounded-25">
                </div>
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <input style="height:50px;border:none;" placeholder="No Telp" type="text" class="form-control rounded-25">
                </div>
                <button class="btnn bg-blacknot w-100">Upload KTP</button><br>
                <button class="btnn bg-redp w-100 mt-3">Sign Up</button>
            </div>
        </div>
    </body>
</html>