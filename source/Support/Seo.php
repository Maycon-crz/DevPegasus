<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo
{
    protected $optmizer;

    public function __construct(string $schema = "article")
    {
        $this->optmizer = new Optimizer();
        $this->optmizer->openGraph(
            SITE,
            "pt-BR",
            $schema
        )->publisher(
            /*TODO: ALTERAR ESSA CONFIGURAÇÃO PARA CONFIGURAÇÃO DO CLIENTE*/
            "RecicladArte",
            "maycon.nascimentodeoliveira.1"
        )->twitterCard(
            "@Maycon35292234",
            "@Maycon35292234",
            "recicladarte.com"
        )->facebook(            
            "914194275850900",
        );        
    }
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string{
        return $this->optmizer->optimize($title, $description, $url, $image, $follow)->render();
    }
}