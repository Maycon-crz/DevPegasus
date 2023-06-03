<?php

define("ROOT", "http://localhost/HOMOLOGACAO_WEB/DevPegasus");

define("SITE", "#Modelo");

// define("DATA_LAYER_CONFIG", [
//     "driver" => "mysql",
//     "host" => "localhost",
//     "port" => "8000",
//     "dbname" => "recicladartedb",
//     "username" => "root",
//     "passwd" => "123",
//     "options" => [
//         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//         PDO::ATTR_CASE => PDO::CASE_NATURAL
//     ]
// ]);

/**
 * @param string|null $uri
 * @return string
 */
function url(string $uri = null): string
{
    if ($uri) {
        return ROOT . "/{$uri}";
    }

    return ROOT;
}