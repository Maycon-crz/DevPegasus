<?php

require __DIR__ . "/vendor/autoload.php";

$route = new \CoffeeCode\Router\Router(ROOT);

/**
 * APP
 */
$route->namespace("Source\App");

/**
 * web
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/contato", "Web:contact");
$route->get("/sobre", "Web:about");
$route->get("/texto", "Web:text");
$route->get("/dicas_conhecimento", "Web:tips_knowledge");
$route->get("/palheta_de_cores", "Web:color_palette");



/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/**
 * PROCESS
 */
$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

//Parei em 16:29