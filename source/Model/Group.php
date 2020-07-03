<?php

    /*
        * Modelo de objeto dos grupos
    */

    namespace Source\Models;

    use CoffeeCode\DataLayer\DataLayer;

    class Group extends DataLayer{

        public function __construct(){
            parent::__construct("rafflegroup", ["id_user", "nome_grupo", "desc_grupo", "data_sorteio", "preco_min", "preco_max", "cod_grupo"], "id_group", false);
        }

    }