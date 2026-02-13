<?php

$server = 'localhost';
$user = 'root';
$password = '';
$database = 'vmss';

$connect = mysqli_connect($server,$user,$password,$database);

if (!$connect) {
    die('CONNECTION ERROR !!');
}