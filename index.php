<?php

require __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(ROOT);

/**
 * APP
 */
$router->namespace("Source\Controllers");

/**
 * web
 */
$router->group(null);
$router->get("/", "WebController:home");
$router->get("/", "WebController:home");
$router->get("/contato", "WebController:contact");
$router->get("/sobre", "WebController:about");
$router->get("/texto", "WebController:text");
$router->get("/dicas_conhecimento", "WebController:tips_knowledge");
$router->get("/palheta_de_cores", "WebController:color_palette");
$router->get("/gerador_de_conteudo", "WebController:contentGenerator");


/**
 * ERROR
 */
$router->group("ops");
$router->get("/{errcode}", "WebController:error");

/**
 * PROCESS
 */
$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}