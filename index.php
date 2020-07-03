<?php

    require __DIR__."/vendor/autoload.php";

    use CoffeeCode\Router\Router;

    $router = new Router(URL);
    $router->namespace("Source\Controller");

    /*
        * WEB
        * home
        * sobre
        * como funciona
    */
    $router->group(null);
    $router->get("/", "Web:home");
    $router->get("/sobre", "Web:sobre");
    $router->get("/comofunciona", "Web:comoFunciona");
    $router->get("/recuperar", "Web:recuperar");
    $router->post("/recuperar/{solicitacao}", "Web:recuperar");
    $router->get("/recuperar/validado/{email}/{token}", "Web:recuperarConfirmado");
    $router->post("/recuperar/validado/{email}/{token}/{alter}", "Web:recuperarConfirmado");

    /*
        * CADASTRO
    */
    $router->group("cadastro");
    $router->post("/", "Web:cadastro");
    
    /*
        * ENTRAR
        * autenticacao
        * cadastroSucedido
    */
    $router->group("entrar");
    $router->get("/", "Web:entrar");
    $router->post("/{autenticacao}", "Web:entrar");
    $router->get("/{cadastro}", "Web:entrar");

    /*
        * DASHBOARD
        * configurações
    */
    $router->group("dashboard");
    $router->get("/", "Web:dashboard");
    $router->get("/{secao}", "Web:dashboard");
    $router->post("/{secao}", "Web:dashboard");
    $router->get("/{secao}/{id}", "Web:dashboard");

    /*
        *ERROR
    */
     $router->group("ooops");
     $router->get("/{errcode}", "Web:error"); // Recebe o código do erro em /erro 

     $router->dispatch();

    if($router->error()){
        $router->redirect("/ooops/{$router->error()}");
    }
