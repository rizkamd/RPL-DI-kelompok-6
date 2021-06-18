<?php

require "classes.php";

$connection = new Connection();
$connection->servername = "localhost";
$connection->username = "root";
$connection->password = "";
$connection->table = "carent";
$conn = $connection->connect();

