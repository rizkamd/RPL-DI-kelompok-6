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

        <div class="bgdiv-truck" style="height:100vh;">
            
            <div class="row" style="width:99vw;">
                <div class="col-2 bg-lightblue p-0" style="height:100vh;">
                    <a href="editdatamobil.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Edit Profil</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Edit Profil</h3>
                    
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
                        <button class="btnn bg-redp w-100 mt-3">Simpan</button>
                        <button class="btnn bg-redp w-100 mt-3">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>