<?php

declare(strict_types=1);

echo "Hello World";
$connection = mysqli_connect('mysql', 'root','root');

//echo "<pre>";
//var_dump($connection);

$connection->query('CREATE DATABASE mensfriends');



