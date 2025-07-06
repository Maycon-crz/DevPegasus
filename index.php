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
$router->get("/dicas_conhecimento", "WebController:tips_knowledge");
$router->get("/palheta_de_cores", "WebController:color_palette");
$router->get("/curriculum_generator", "WebController:curriculumGenerator");
$router->post("/curriculum_render", "UserController:curriculumGeneratorController");
$router->get("/servico_de_desenvolvimento", "WebController:developmentService");
$router->get("/portfolio/{section}", "WebController:portfolio");
$router->get("/politica", "WebController:politics");
$router->get("/feed", "WebController:feed");

$router->get("/login", "AuthenticationController:loginPageController");
$router->get("/user", "UserController:dashboard");

/**
 * LUANA IA
 */
$router->group("/luana");
$router->post("/login", "AuthenticationController:luanaIALogin");
$router->get("/", "LuanaController:luanaIAController");
$router->post("/api/karaoke", "LuanaController:karaokeRegisterMusicController");
// LuanaController

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