<?php

spl_autoload_register(function($class) {
    $fn = 'classes/'.$class.'.php';
    if (file_exists($fn)) { require $fn; }
});

function q(string $request) {
    $mysqli = new mysqli("127.0.0.1:8889", "root", "root", "animals");

    if ($mysqli->errno) { var_dump($mysqli->error); }

    $query = $mysqli->query($request);

    if ($mysqli->insert_id) {
        return $mysqli->insert_id;
    }
    return $query;
}