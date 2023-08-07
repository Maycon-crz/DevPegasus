<?php

require __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(ROOT);

/**
 * APP
 */
$router->namespace("source\Controllers");

/**
 * web
 */
$router->group(null);
$router->get("/", "WebController:home");
$router->get("/", "WebController:home");
$router->get("/contato", "WebController:contact");
$router->get("/sobre", "WebController:about");
$router->get("/texto", "WebController:text");
$router->get("/dicas_conhecimento", "WebController:tips_knowledge");/*Arrumar essa nome de função*/
$router->get("/palheta_de_cores", "WebController:color_palette");/*Arrumar essa nome de função*/
$router->get("/curriculum_generator", "WebController:curriculumGenerator");
$router->get("/feed", "WebController:feed");

$router->get("/login", "AuthenticationController:loginPageController");
$router->get("/user", "UserController:dashboard");


/**
 * LUANA IA
 */
$router->group("luana");
$router->get("/", "AdministratorController:luanaIA");
// $router->post("/api/{section}", "AdministratorController:luanaAPI");

/**
 * API
 */
$router->group("/api");
$router->post("/createsession", "AuthenticationController:createSession");
$router->post("/login", "AuthenticationController:loginController");
$router->post("/logout", "AuthenticationController:logoutController");
$router->post("/post/{section}", "UserController:post");


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