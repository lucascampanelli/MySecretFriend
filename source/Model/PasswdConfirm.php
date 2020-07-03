<?php

    /*
        * Modelo de objeto da recuperação de senha
    */

    namespace Source\Models;

    use CoffeeCode\DataLayer\DataLayer;

    class PasswdConfirm extends DataLayer{

        public function __construct(){

            //(nome_table, [obligatory fields], primary, bool timestamps = true)
            parent::__construct("passwd_recover", ["token_recover", "user"], "id_recover", false);
        }

    }
