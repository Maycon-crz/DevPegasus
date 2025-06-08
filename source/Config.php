<?php

define("ROOT", "https://www.devpegasus.com");

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