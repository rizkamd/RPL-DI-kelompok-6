<?php

//cek jika session belum login 
if (!isset($_SESSION["id"]))
{
    header("Location: home.php");
    exit;
}

$admin = new Admin($conn);
$admin->getDataById($_SESSION["id"]);

?>