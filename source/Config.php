<?php

define("ROOT", "http://localhost/HOMOLOGACAO_WEB/DevPegasus");

define("SITE", "DevPegasus");

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