<?php

//cek jika session belum login 
if (!isset($_SESSION["id"]))
{
    header("Location: home.php");
    exit;
}

$customer = new Customer($conn);
$customer->getDataById($_SESSION["id"]);

?>