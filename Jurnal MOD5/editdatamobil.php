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
                    <a href="lihatdatarental.php" class="btn bg-lightblue text-dark w-100 m-0">Lihat Data Rental</a>
                    <a href="editdatamobil.php" class="btn bg-lightblue text-dark w-100 m-0 font-weight-bold">Edit Data Mobil</a>
                </div>
            
                <div class="col">
                    <h3 class="mt-4 mb-4">Edit Data Mobil</h3>
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Jenis Mobil</th>
                            <th scope="col">Harga Rental</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>