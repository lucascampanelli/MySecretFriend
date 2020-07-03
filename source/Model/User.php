<?php

    /*
        * Modelo de objeto dos usuários
    */

    namespace Source\Models;

    use CoffeeCode\DataLayer\DataLayer;

    class User extends DataLayer{

        public function __construct(){

            //(nome_table, [obligatory fields], primary, bool timestamps = true)
            parent::__construct("user", ["nome_user", "sobrenome_user", "email", "senha"], "id_user", false);
        }

    }
