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
        <?php require 'navbar.php'; ?>

        <div class="bgdiv-truck" style="height:100vh;">
            <img src="img/Ellipse 4.png" class="pt-5 mx-auto d-block" style="width:200px; height:auto;">
            <h2 class="text-center pt-2" style="font-family:'Ripeye';font-weight:900;font-size:60px;">CaRent</h2>
            <div class="container p-3 w-50">
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-25 bg-lightblue" id="inputGroup-sizing-default">
                            <img src="img/profile.png" width="37px" height="auto">
                        </span>
                    </div>
                    <input style="height:50px;border:none;" placeholder="Username" type="text" class="form-control rounded-25">
                </div>
                <div class="input-group mb-3 bg-white rounded-25 shadow">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-25 bg-lightblue" id="inputGroup-sizing-default">
                            <img src="img/password.jpg" width="auto" height="37px">
                        </span>
                    </div>
                    <input style="height:50px;border:none;" placeholder="Password" type="password" class="form-control rounded-25">
                </div>
                <button class="btnn bg-redp w-100">Login</button>
            </div>
        </div>
    </body>
</html>